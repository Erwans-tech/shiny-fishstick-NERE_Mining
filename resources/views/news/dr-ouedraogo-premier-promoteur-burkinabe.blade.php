{{-- Page : Actualité - Dr Elie Justin OUEDRAOGO --}}
@extends('layouts.app')

@section('content')
@php
    $en = ($locale ?? 'fr') === 'en';
@endphp

<style>
    .news-detail { max-width:900px; margin:0 auto; }
    .news-detail-header { margin-bottom:40px; }
    .news-detail-meta { display:flex; gap:16px; align-items:center; margin-bottom:20px; flex-wrap:wrap; }
    .news-detail-category { background:var(--gold); color:var(--ink); padding:6px 14px; border-radius:20px; font:600 11px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase; }
    .news-detail-date { color:var(--muted); font:500 13px Inter,sans-serif; }
    .news-detail-title { font-size:clamp(32px,5vw,48px); line-height:1.1; color:var(--green); margin-bottom:24px; font-weight:600; }
    .news-detail-excerpt { font-size:20px; line-height:1.6; color:var(--muted); margin-bottom:32px; font-weight:500; }
    .news-detail-image { width:100%; border-radius:12px; margin-bottom:40px; box-shadow:0 8px 24px rgba(0,0,0,0.12); }
    .news-detail-content { font-size:17px; line-height:1.8; color:var(--ink); }
    .news-detail-content p { margin-bottom:20px; text-align:justify; }
    .news-detail-content h3 { color:var(--green); font-size:24px; margin:40px 0 16px; font-weight:600; }
    .news-detail-content strong { color:var(--green); font-weight:700; }
    .news-detail-stats { display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:16px; background:var(--sand); padding:24px; border-radius:8px; margin:32px 0; border-left:4px solid var(--gold); }
    .news-detail-stat { text-align:center; }
    .news-detail-stat-value { font-size:32px; font-weight:800; color:var(--green); display:block; }
    .news-detail-stat-label { font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; font-weight:600; margin-top:8px; }
    .news-detail-image-secondary { width:100%; border-radius:8px; margin:32px 0; box-shadow:0 4px 16px rgba(0,0,0,0.1); }
    .news-detail-author { margin-top:48px; padding-top:24px; border-top:2px solid var(--line); font-style:italic; color:var(--muted); }
</style>

<section class="news-detail">
    <div class="news-detail-header">
        <div class="news-detail-meta">
            <span class="news-detail-category">Portrait</span>
            <span class="news-detail-date">14 septembre 2026</span>
        </div>
        
        <h1 class="news-detail-title">Zoom sur le Dr Elie Justin OUEDRAOGO, Premier promoteur burkinabè dans les mines</h1>
        
        <p class="news-detail-excerpt">
            Dr Elie Justin OUEDRAOGO, Naaba Baaôgo de Gourcy est le dirigeant burkinabè qui possède la plus grande expérience et l'expertise minière au Burkina Faso et en Afrique de l'Ouest.
        </p>
    </div>
    
    <img src="{{ asset('images/news/ouedraogo-ceo-interview.jpeg') }}" alt="Dr Elie Justin OUEDRAOGO" class="news-detail-image">
    
    <div class="news-detail-content">
        <p>
            Dr Elie Justin OUEDRAOGO, Naaba Baaôgo de Gourcy est le dirigeant burkinabè qui possède la plus grande expérience et l'expertise minière au Burkina Faso et en Afrique de l'Ouest. C'est grâce à cette expérience que la mine de Riverstone Karma SA, dont il est le PDG, fait preuve de résilience et poursuit son exploitation, malgré les crises.
        </p>
        
        <p>
            Riverstone Karma SA sera présent à la 8e édition de la Semaine des activités minières d'Afrique de l'Ouest (SAMAO), couplée à la première édition de la Semaine de l'énergie, des mines et des hydrocarbures de la Confédération des États du Sahel (SEMH-AES), se tiendra du 14 au 19 septembre 2026 à Ouagadougou, sur le thème : <strong>« Gouvernance des ressources extractives : enjeux géopolitiques, défis et opportunités pour les Etats africains »</strong>.
        </p>

        <h3>Un parcours d'excellence</h3>
        
        <p>
            Dr Elie Justin OUEDRAOGO est titulaire d'un Master en finance et d'un Doctorat en économie et travaille dans l'industrie minière au Burkina Faso depuis 32 ans. Entre 1995 et 2000, il a été <strong>Ministre des Mines et de l'énergie</strong> au Burkina Faso.
        </p>
        
        <p>
            Il a une très bonne connaissance de l'environnement politique et administratif du secteur minier au Burkina Faso. Il a commencé sa carrière en tant que Directeur général d'une société minière au Burkina Faso (Soremib – mine de Poura) avant d'être le Directeur National d'une société minière internationale (SEMAFO).
        </p>
        
        <p>
            Il est toujours <strong>Président du Conseil d'Administration</strong> des sociétés minières au Burkina Faso pour Endeavour Mining (Riverstone Karma et Semafo Mana). Egalement président d'honneur de la Chambre des mines du Burkina Faso et du Conseil national du patronat burkinabè, il est co-président de l'Union des Chambres des Mines de l'UEMOA.
        </p>
        
        <p>
            Dr Elie Justin OUEDRAOGO exploite la mine de Riverstone Karma avec une <strong>direction 100% nationale</strong>.
        </p>

        <h3>Riverstone Karma, la mine résiliente</h3>
        
        <p>
            Riverstone Karma a fait preuve de résilience depuis sa création.
        </p>
        
        <p>
            En 2015, une partie des installations et des gros engins ont été incendiés par des populations, causant des dommages d'une valeur d'environ <strong>3 milliards FCFA</strong>.
        </p>
        
        <p>
            Depuis sa reprise en mars 2022 auprès de la multinationale Endeavour Mining, la mine a connu des 02 incidents majeurs de sécurité (attaques armées), causant des incendies de véhicules et deux décès. Malgré tout, la mine a maintenu ses activités.
        </p>

        <img src="{{ asset('images/news/karma-mine-map.jpg') }}" alt="Carte de la mine de Karma" class="news-detail-image-secondary">

        <h3>Riverstone Karma poursuit ses investissements communautaires</h3>
        
        <div class="news-detail-stats">
            <div class="news-detail-stat">
                <span class="news-detail-stat-value">1,86</span>
                <span class="news-detail-stat-label">Tonnes d'or (2023)</span>
            </div>
            <div class="news-detail-stat">
                <span class="news-detail-stat-value">409</span>
                <span class="news-detail-stat-label">Emplois directs (2024)</span>
            </div>
            <div class="news-detail-stat">
                <span class="news-detail-stat-value">15 000</span>
                <span class="news-detail-stat-label">Emplois sous-traitants</span>
            </div>
        </div>
        
        <p>
            La production d'or de Karma est passé de <strong>1,353 tonnes</strong> d'or en 2022 à <strong>1,86 tonnes</strong> en 2023 pour se situer à <strong>1,419 tonnes</strong> en 2024 et à <strong>1,168 tonnes</strong> en 2025, selon les données des rapports ITIE-BF.
        </p>
        
        <p>
            En 2024, Karma a payé <strong>13,097 milliards FCFA</strong> au budget de l'Etat. En 2024, Karma a créé <strong>409 emplois directs</strong> et environ <strong>15 000</strong> chez les sous-traitants.
        </p>
        
        <p>
            La somme de <strong>77,809 milliards FCFA</strong> a été consacrée aux achats de biens et services auprès d'entreprises burkinabè en 2024, toujours selon le rapport ITIE-BF 2024. Ce montant représente <strong>98,23%</strong> des achats de l'année de la société.
        </p>
        
        <div class="news-detail-author">
            <p>Pierre Balma<br>Mines Actu Burkina</p>
        </div>
    </div>
</section>

@endsection
