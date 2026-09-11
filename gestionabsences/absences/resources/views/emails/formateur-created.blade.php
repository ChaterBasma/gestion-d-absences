<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .content {
            padding: 40px 20px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
        }
        .greeting strong {
            color: #667eea;
        }
        .info-box {
            background-color: #f9f9f9;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box p {
            margin: 8px 0;
        }
        .info-box .label {
            font-weight: bold;
            color: #667eea;
        }
        .button {
            display: inline-block;
            background-color: #667eea;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
            font-weight: bold;
        }
        .button:hover {
            background-color: #764ba2;
        }
        .footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎓 Bienvenue!</h1>
        </div>

        <div class="content">
            <div class="greeting">
                Bonjour <strong>{{ $formateur->Prenom }} {{ $formateur->Nom }}</strong>,
            </div>

            <p>
                Nous vous accueillons avec plaisir dans notre plateforme de formation. 
                Un compte formateur a été créé pour vous pour accéder à la gestion des séances et du suivi des apprenants.
            </p>

            <div class="info-box">
                <p><span class="label">📋 Identifiants d'accès:</span></p>
                <p><span class="label">Matricule:</span> <code>{{ $formateur->Matricule }}</code></p>
                <p><span class="label">Email:</span> <code>{{ $formateur->email }}</code></p>
                <p style="margin-top: 10px; color: #999; font-size: 12px;">
                    ⚠️ Conservez ces identifiants en sécurité.
                </p>
            </div>

            <p>
                Avec votre compte, vous pourrez:
            </p>
            <ul>
                <li>✅ Créer et gérer vos séances de formation</li>
                <li>✅ Consulter l'avancement par groupe et module</li>
                <li>✅ Suivre les absences et la participation</li>
                <li>✅ Accéder aux modules et groupes assignés</li>
            </ul>

            <p style="margin-top: 30px;">
                Si vous avez des questions ou besoin d'assistance, n'hésitez pas à contacter l'équipe d'administration.
            </p>

            <p style="margin-top: 20px; color: #999;">
                Cordialement,<br>
                <strong>{{ $appName }}</strong>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ $appName }}. Tous droits réservés.</p>
            <p>Cet email a été envoyé automatiquement. Veuillez ne pas y répondre.</p>
        </div>
    </div>
</body>
</html>
