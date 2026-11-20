@php
    $nf = fn ($n) => number_format((float) $n, 0, ',', ' ');
    $logoPath = public_path('images/logo-nere.png');
    $logo = is_file($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : null;

    // Daily chart: at most 31 bars (longer periods are grouped)
    $bucketSize = max(1, (int) ceil($visitsByDay->count() / 31));
    $bars = $visitsByDay->chunk($bucketSize)->map(fn ($chunk) => [
        'label' => $chunk->first()['date'],
        'count' => $chunk->sum('count'),
    ])->values();
    $barMax = max(1, $bars->max('count'));
    $hourMax = max(1, $peakHours->max('count'));
    $pageMax = max(1, $topPages->max('visits') ?? 1);
    $refMax = max(1, $referrers->max('visits') ?? 1);
    $busiestHour = $peakHours->sortByDesc('count')->first();
    $periodLabel = [7 => '7 derniers jours', 30 => '30 derniers jours', 90 => '3 derniers mois', 365 => '12 derniers mois'][$days] ?? $days . ' jours';
    $change = function ($value, bool $lowerIsBetter = false) {
        if ($value === null) return '<span class="muted">pas de comparaison</span>';
        $good = $lowerIsBetter ? $value <= 0 : $value >= 0;
        return '<span class="' . ($good ? 'up' : 'down') . '">' . ($value > 0 ? '+' : '') . $value . ' %</span> vs période précédente';
    };
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Statistiques du site - Néré Mining</title>
<style>
    @page { margin: 26px 30px 40px; }
    * { box-sizing: border-box; }
    body { font-family: 'DejaVu Sans', Arial, sans-serif; font-size: 10px; color: #2b2220; margin: 0; }
    .header { background: #4b1716; color: #fff; padding: 16px 20px; border-bottom: 4px solid #ffc247; }
    .header table { width: 100%; border-collapse: collapse; }
    .header img { width: 150px; }
    .header td { vertical-align: middle; }
    .header h1 { font-size: 17px; margin: 0 0 3px; color: #fff; }
    .header .sub { color: #ffc247; font-size: 10px; }
    .header .meta { text-align: right; font-size: 9px; color: #f3e3d0; line-height: 1.5; }
    h2 { font-size: 12px; color: #4b1716; margin: 18px 0 8px; padding-bottom: 4px; border-bottom: 1px solid #ead9c6; }
    .kpis { width: 100%; border-collapse: separate; border-spacing: 6px 0; margin: 14px -6px 0; }
    .kpi { background: #fbf6ef; border: 1px solid #ead9c6; border-top: 3px solid #ffc247; padding: 9px 10px; width: 25%; vertical-align: top; }
    .kpi .label { font-size: 8.5px; text-transform: uppercase; letter-spacing: .4px; color: #7a6a64; }
    .kpi .value { font-size: 19px; font-weight: bold; color: #4b1716; margin: 3px 0 2px; }
    .kpi .note { font-size: 8px; color: #7a6a64; }
    .up { color: #1e7a46; font-weight: bold; }
    .down { color: #C8102E; font-weight: bold; }
    .muted { color: #9a8b85; }
    .chart { width: 100%; border-collapse: collapse; table-layout: fixed; }
    .chart td { vertical-align: bottom; text-align: center; padding: 0 1px; }
    .chart .bar { background: #C8102E; width: 100%; }
    .chart .bar.gold { background: #ffc247; }
    .chart .num { font-size: 6.5px; color: #7a6a64; }
    .chart .lbl { font-size: 6.5px; color: #7a6a64; padding-top: 3px; border-top: 1px solid #d9c7b4; }
    .cols { width: 100%; border-collapse: collapse; }
    .cols > tbody > tr > td { width: 50%; vertical-align: top; }
    .cols > tbody > tr > td:first-child { padding-right: 10px; }
    .cols > tbody > tr > td:last-child { padding-left: 10px; }
    .list { width: 100%; border-collapse: collapse; }
    .list td { padding: 4px 0; border-bottom: 1px solid #f1e6da; }
    .list .name { width: 46%; word-break: break-all; padding-right: 6px; }
    .list .track { background: #f3ebe1; height: 7px; }
    .list .fill { background: #4b1716; height: 7px; }
    .list .count { width: 14%; text-align: right; font-weight: bold; color: #4b1716; }
    .empty { color: #9a8b85; font-style: italic; padding: 6px 0; }
    .small-kpis { width: 100%; border-collapse: collapse; }
    .small-kpis td { padding: 6px 8px; border: 1px solid #ead9c6; width: 25%; }
    .small-kpis .value { font-size: 13px; font-weight: bold; color: #4b1716; }
    .footer { position: fixed; bottom: -26px; left: 0; right: 0; font-size: 8px; color: #9a8b85; text-align: center; }
</style>
</head>
<body>
<div class="footer">Néré Mining — rapport généré le {{ $exportDate->format('d/m/Y à H:i') }} depuis l'administration du site</div>

<div class="header">
    <table><tr>
        <td style="width:172px">@if($logo)<img src="{{ $logo }}" alt="Néré Mining">@endif</td>
        <td>
            <h1>Statistiques du site</h1>
            <div class="sub">{{ $periodLabel }} — du {{ $startDate->format('d/m/Y') }} au {{ $exportDate->format('d/m/Y') }}</div>
        </td>
        <td class="meta">www.nere-mining.bf<br>Généré le {{ $exportDate->format('d/m/Y') }}</td>
    </tr></table>
</div>

<table class="kpis"><tr>
    <td class="kpi">
        <div class="label">Visites</div>
        <div class="value">{{ $nf($totalVisits) }}</div>
        <div class="note">{!! $change($visitsChange) !!}</div>
    </td>
    <td class="kpi">
        <div class="label">Visiteurs uniques</div>
        <div class="value">{{ $nf($uniqueVisitors) }}</div>
        <div class="note">{{ $nf($recurringVisitors) }} revenus plusieurs fois ({{ $recurringRate }} %)</div>
    </td>
    <td class="kpi">
        <div class="label">Pages par visiteur</div>
        <div class="value">{{ str_replace('.', ',', $avgPagesPerVisit) }}</div>
        <div class="note">moyenne sur la période</div>
    </td>
    <td class="kpi">
        <div class="label">Taux de rebond</div>
        <div class="value">{{ $bounceRate }} %</div>
        <div class="note">{!! $change($bounceRateChange, true) !!}</div>
    </td>
</tr></table>

<h2>Visites {{ $bucketSize > 1 ? 'par période de ' . $bucketSize . ' jours' : 'par jour' }}</h2>
<table class="chart">
    <tr>
        @foreach($bars as $bar)
            <td style="height:110px">
                @if($bar['count'] > 0)<div class="num">{{ $bar['count'] }}</div>@endif
                <div class="bar" style="height:{{ max($bar['count'] > 0 ? 2 : 0, round($bar['count'] / $barMax * 95)) }}px"></div>
            </td>
        @endforeach
    </tr>
    <tr>
        @foreach($bars as $i => $bar)
            <td class="lbl">{{ ($bars->count() <= 16 || $i % 2 === 0) ? $bar['label'] : '' }}</td>
        @endforeach
    </tr>
</table>

<table class="cols"><tr>
    <td>
        <h2>Pages les plus vues</h2>
        @if($topPages->isEmpty())
            <div class="empty">Aucune visite sur la période.</div>
        @else
            <table class="list">
                @foreach($topPages as $page)
                    <tr>
                        <td class="name">{{ $page['url'] }}</td>
                        <td><div class="track"><div class="fill" style="width:{{ round($page['visits'] / $pageMax * 100) }}%"></div></div></td>
                        <td class="count">{{ $nf($page['visits']) }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </td>
    <td>
        <h2>Provenance des visiteurs</h2>
        @if($referrers->isEmpty())
            <div class="empty">Aucune source enregistrée.</div>
        @else
            <table class="list">
                @foreach($referrers->take(10) as $ref)
                    <tr>
                        <td class="name">{{ $ref['source'] === 'Direct' ? 'Accès direct' : $ref['source'] }}</td>
                        <td><div class="track"><div class="fill" style="width:{{ round($ref['visits'] / $refMax * 100) }}%"></div></div></td>
                        <td class="count">{{ $nf($ref['visits']) }}</td>
                    </tr>
                @endforeach
            </table>
        @endif

        <h2>Appareils</h2>
        <table class="list">
            @foreach(['desktop' => 'Ordinateur', 'mobile' => 'Mobile', 'tablet' => 'Tablette'] as $key => $label)
                <tr>
                    <td class="name">{{ $label }}</td>
                    <td><div class="track"><div class="fill" style="width:{{ $devices[$key]['percent'] }}%"></div></div></td>
                    <td class="count">{{ $devices[$key]['percent'] }} %</td>
                </tr>
            @endforeach
        </table>
    </td>
</tr></table>

<h2>Heures de fréquentation @if($busiestHour && $busiestHour['count'] > 0)<span class="muted" style="font-weight:normal">— pic à {{ $busiestHour['hour'] }}</span>@endif</h2>
<table class="chart">
    <tr>
        @foreach($peakHours as $hour)
            <td style="height:62px">
                <div class="bar gold" style="height:{{ max($hour['count'] > 0 ? 2 : 0, round($hour['count'] / $hourMax * 55)) }}px"></div>
            </td>
        @endforeach
    </tr>
    <tr>
        @foreach($peakHours as $i => $hour)
            <td class="lbl">{{ $i % 3 === 0 ? substr($hour['hour'], 0, 2) . 'h' : '' }}</td>
        @endforeach
    </tr>
</table>

<h2>Activité sur la période</h2>
<table class="small-kpis"><tr>
    <td>Messages de contact<br><span class="value">{{ $nf($activity['messages']) }}</span></td>
    <td>Candidatures reçues<br><span class="value">{{ $nf($activity['applications']) }}</span></td>
    <td>Inscriptions newsletter<br><span class="value">{{ $nf($activity['newsletter']) }}</span></td>
    <td>Actualités ajoutées<br><span class="value">{{ $nf($activity['news']) }}</span></td>
</tr></table>
</body>
</html>
