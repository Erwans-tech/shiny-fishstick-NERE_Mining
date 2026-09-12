@php
    // HARDCODED PARTNERS - No database dependency
    $hardcodedPartners = [
        (object) [
            'id' => 1,
            'name' => 'NEEMBA',
            'category' => $en ? 'Institutional Partner' : 'Partenaire Institutionnel',
            'logo_path' => 'images/partners/neemba-logo.jpeg',
            'website_url' => null,
        ],
    ];
    $partners = collect($partners ?? [])->isEmpty() ? collect($hardcodedPartners) : collect($partners);
@endphp
<section><p class="lead">{{ $en ? 'Our institutional and technical partners contribute to mining development rooted in Burkina Faso priorities.' : 'Nos partenaires institutionnels et techniques contribuent à un développement minier ancré dans les priorités du Burkina Faso.' }}</p><div class="grid-3">@forelse($partners as $partner)<article class="card">@if(isset($partner->logo_path) && $partner->logo_path)<img class="card-img" src="{{ asset($partner->logo_path) }}" alt="Logo {{ $partner->name }}" loading="lazy" style="object-fit:contain; background:#fff; padding:20px;">@endif<div class="card-tag">{{ $partner->category ?? ($en ? 'Partner' : 'Partenaire') }}</div><h3>{{ $partner->name }}</h3>@if(isset($partner->website_url) && $partner->website_url)<a class="btn btn-gold" href="{{ $partner->website_url }}" target="_blank" rel="noopener">{{ $en ? 'Visit website' : 'Voir le site' }}</a>@endif</article>@empty<p class="lead">{{ $en ? 'Partners will be published shortly.' : 'Les partenaires seront publiés prochainement.' }}</p>@endforelse</div></section>