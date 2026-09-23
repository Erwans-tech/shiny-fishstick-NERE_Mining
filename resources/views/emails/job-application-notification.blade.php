<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle candidature - Néré Mining</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #4b1716 0%, #d72f2f 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header .subtitle {
            margin: 8px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .job-badge {
            background-color: #ffc247;
            color: #4b1716;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-top: 10px;
            display: inline-block;
        }
        .content {
            padding: 30px 20px;
        }
        .candidate-info {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #ffc247;
        }
        .candidate-name {
            font-size: 20px;
            font-weight: 600;
            color: #4b1716;
            margin-bottom: 5px;
        }
        .candidate-contact {
            color: #666;
            font-size: 14px;
        }
        .field-group {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 6px;
        }
        .field-label {
            font-weight: 600;
            color: #4b1716;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .field-value {
            font-size: 16px;
            color: #333;
        }
        .motivation-content {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 20px;
            margin-top: 10px;
            white-space: pre-wrap;
            line-height: 1.7;
        }
        .attachments {
            background-color: #e8f4fd;
            border: 1px solid #b8e0ff;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }
        .attachment-item {
            display: flex;
            align-items: center;
            margin: 8px 0;
            font-size: 14px;
            color: #0056b3;
        }
        .attachment-item::before {
            content: "📎";
            margin-right: 8px;
        }
        .footer {
            background-color: #f1f3f4;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 0;
            font-size: 12px;
            color: #6c757d;
        }
        .admin-link {
            display: inline-block;
            background-color: #4b1716;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            margin: 5px;
        }
        .admin-link:hover {
            background-color: #3a100f;
        }
        .reply-info {
            background-color: #e8f4fd;
            border: 1px solid #b8e0ff;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }
        .reply-info strong {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🎯 Nouvelle candidature</h1>
            <p class="subtitle">Candidature reçue sur le site Néré Mining</p>
            @if($jobOffer)
                <div class="job-badge">{{ $jobOffer->title }}</div>
            @endif
        </div>
        
        <div class="content">
            <div class="candidate-info">
                <div class="candidate-name">{{ $application->full_name }}</div>
                <div class="candidate-contact">
                    📧 <a href="mailto:{{ $application->email }}" style="color: #d72f2f; text-decoration: none;">{{ $application->email }}</a>
                    @if($application->phone)
                        <br>📞 {{ $application->phone }}
                    @endif
                </div>
            </div>
            
            @if($jobOffer)
            <div class="field-group">
                <div class="field-label">Poste visé</div>
                <div class="field-value">
                    {{ $jobOffer->title }}
                    @if($jobOffer->department)
                        <br><small style="color: #666;">Département : {{ $jobOffer->department }}</small>
                    @endif
                </div>
            </div>
            @endif
            
            @if($application->nationality)
            <div class="field-group">
                <div class="field-label">Nationalité</div>
                <div class="field-value">{{ $application->nationality }}</div>
            </div>
            @endif
            
            @if($application->current_position)
            <div class="field-group">
                <div class="field-label">Poste actuel</div>
                <div class="field-value">{{ $application->current_position }}</div>
            </div>
            @endif
            
            @if($application->experience_years)
            <div class="field-group">
                <div class="field-label">Années d'expérience</div>
                <div class="field-value">{{ $application->experience_years }}</div>
            </div>
            @endif
            
            <div class="field-group">
                <div class="field-label">Date de candidature</div>
                <div class="field-value">{{ $application->created_at->format('d/m/Y à H:i') }}</div>
            </div>
            
            <div class="field-group">
                <div class="field-label">Lettre de motivation</div>
                <div class="motivation-content">{{ $application->motivation }}</div>
            </div>
            
            @if($application->cv_path || $application->cover_letter_path)
            <div class="attachments">
                <strong>📎 Pièces jointes :</strong>
                @if($application->cv_path)
                    <div class="attachment-item">CV - {{ $application->full_name }}</div>
                @endif
                @if($application->cover_letter_path)
                    <div class="attachment-item">Lettre de motivation - {{ $application->full_name }}</div>
                @endif
                <small style="color: #666; font-style: italic;">
                    Les fichiers sont joints à cet e-mail
                </small>
            </div>
            @endif
            
            <div class="reply-info">
                <strong>💡 Pour répondre :</strong> Répondez directement à cet e-mail, votre réponse sera envoyée à {{ $application->full_name }} ({{ $application->email }}).
            </div>
            
            <div style="text-align: center;">
                <a href="{{ config('app.url') }}/admin/candidatures/{{ $application->id }}" class="admin-link">
                    👁️ Voir dans l'admin
                </a>
                @if($application->cv_path)
                <a href="{{ config('app.url') }}/admin/candidatures/{{ $application->id }}/cv" class="admin-link">
                    📄 Télécharger CV
                </a>
                @endif
            </div>
        </div>
        
        <div class="footer">
            <p>
                <strong>Néré Mining</strong><br>
                Notification automatique - Ne pas répondre à cette adresse<br>
                Généré le {{ now()->format('d/m/Y à H:i') }}
            </p>
        </div>
    </div>
</body>
</html>