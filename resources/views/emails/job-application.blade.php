<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }
        .header {
            background-color: #C8102E;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            background-color: white;
        }
        .section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f5f5f5;
            border-left: 4px solid #D4AF37;
            border-radius: 4px;
        }
        .section-title {
            font-weight: bold;
            color: #C8102E;
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .section-content {
            font-size: 14px;
            color: #555;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #e0e0e0;
        }
        .badge {
            display: inline-block;
            background-color: #D4AF37;
            color: #333;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-right: 5px;
        }
        a {
            color: #C8102E;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 Nouvelle candidature</h1>
        </div>

        <div class="content">
            <p>Bonjour,</p>

            <p>Une nouvelle candidature a été reçue via le site Néré Mining. Veuillez trouver les détails ci-dessous :</p>

            <!-- Informations personnelles -->
            <div class="section">
                <div class="section-title">👤 Informations personnelles</div>
                <div class="section-content">
                    <p><strong>Nom :</strong> {{ $application->last_name }}<br>
                    <strong>Prénom :</strong> {{ $application->first_name }}<br>
                    <strong>Email :</strong> <a href="mailto:{{ $application->email }}">{{ $application->email }}</a><br>
                    <strong>Téléphone :</strong> {{ $application->phone ?? 'Non fourni' }}<br>
                    <strong>Nationalité :</strong> {{ $application->nationality ?? 'Non fourni' }}</p>
                </div>
            </div>

            <!-- Informations professionnelles -->
            <div class="section">
                <div class="section-title">💼 Informations professionnelles</div>
                <div class="section-content">
                    <p><strong>Poste actuel :</strong> {{ $application->current_position ?? 'Non fourni' }}<br>
                    <strong>Années d'expérience :</strong> {{ $application->experience_years ?? 'Non fourni' }}<br>
                    <strong>Offre ciblée :</strong> 
                    @if($job)
                        {{ $job->title }}
                        @if($job->is_spontaneous)
                            <span class="badge">Spontanée</span>
                        @endif
                    @else
                        Non disponible
                    @endif
                    </p>
                </div>
            </div>

            <!-- Motivation -->
            <div class="section">
                <div class="section-title">📝 Motivation du candidat</div>
                <div class="section-content">
                    {{ nl2br(e($application->motivation)) }}
                </div>
            </div>

            <!-- Documents joints -->
            @if($application->cv_path || $application->cover_letter_path)
            <div class="section">
                <div class="section-title">📎 Documents joints</div>
                <div class="section-content">
                    @if($application->cv_path)
                        ✓ CV fourni<br>
                    @endif
                    @if($application->cover_letter_path)
                        ✓ Lettre de motivation fournie
                    @endif
                </div>
            </div>
            @endif

            <!-- Détails de soumission -->
            <div class="section">
                <div class="section-title">⏰ Détails de soumission</div>
                <div class="section-content">
                    <p><strong>Date de soumission :</strong> {{ $application->created_at->format('d/m/Y à H:i') }}<br>
                    <strong>ID candidature :</strong> #{{ $application->id }}</p>
                </div>
            </div>

            <!-- Appel à action -->
            <p style="text-align: center; margin-top: 30px;">
                <a href="{{ route('admin.job-applications.show', $application->id) }}" style="background-color: #C8102E; color: white; padding: 10px 20px; border-radius: 5px; display: inline-block; text-decoration: none;">
                    Consulter la candidature
                </a>
            </p>

            <p>Cordialement,<br>
            <strong>Système de gestion Néré Mining</strong></p>
        </div>

        <div class="footer">
            <p>Cet email a été généré automatiquement par le système de gestion des candidatures de Néré Mining.<br>
            © {{ date('Y') }} Néré Mining. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>
