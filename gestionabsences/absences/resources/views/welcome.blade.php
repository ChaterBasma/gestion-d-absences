<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GestAbsence, la plateforme OFPPT pour piloter les séances, les absences et l'avancement pédagogique.">
    <title>GestAbsence | Pilotage de la formation</title>
    @vite(['resources/css/landing.css'])
</head>

<body class="landing-page">
    <div class="landing-shell">
        <header class="landing-header">
            <a class="brand" href="{{ url('/') }}" aria-label="GestAbsence, accueil">
                <span class="brand-mark" aria-hidden="true"><span></span><span></span><span></span></span>
                <span><strong>Gest</strong><b>Absence</b><small>OFPPT · PILOTAGE DE LA FORMATION</small></span>
            </a>
            <nav class="landing-nav" aria-label="Navigation principale">
                <a href="#plateforme">La plateforme</a>
                <a href="#fonctionnalites">Fonctionnalités</a>
                <a href="#roles">Pour chaque rôle</a>
            </nav>
            <a class="header-login" href="{{ route('login') }}">Accéder à l'espace <span aria-hidden="true">↗</span></a>
        </header>

        <main>
            <section class="hero" id="plateforme">
                <div class="hero-copy">
                    <p class="eyebrow"><span></span> Le suivi pédagogique, en un seul endroit</p>
                    <h1>Donnez du rythme<br>à votre <em>formation.</em></h1>
                    <p class="hero-text">GestAbsence simplifie le suivi quotidien des séances, des présences et de l'avancement pour que chaque acteur puisse se concentrer sur l'essentiel : la réussite des stagiaires.</p>
                    <div class="hero-actions">
                        <a class="button button-primary" href="{{ route('login') }}">Ouvrir mon espace <span aria-hidden="true">→</span></a>
                        <a class="text-link" href="#fonctionnalites">Découvrir la plateforme <span aria-hidden="true">↓</span></a>
                    </div>
                    <div class="trust-line"><span class="trust-dot"></span><span>Un espace partagé pour l'administration, la direction et les formateurs</span></div>
                </div>

                <div class="hero-visual" aria-label="Aperçu du tableau de suivi GestAbsence">
                    <div class="visual-glow"></div>
                    <div class="dashboard-window">
                        <div class="window-top"><span class="window-dots"><i></i><i></i><i></i></span><span>gestabsence / tableau de bord</span><span class="window-date">09 SEPT. 2026</span></div>
                        <div class="window-body">
                            <div class="mock-sidebar"><div class="mock-logo"><span></span>GestAbsence</div><span class="side-active">◈ Vue d'ensemble</span><span>▣ Séances</span><span>◌ Absences</span><span>▤ Avancement</span><div class="side-bottom">⚙ Paramètres</div></div>
                            <div class="mock-content">
                                <div class="mock-heading"><div><small>Bonjour, équipe pédagogique</small><h2>Vue d'ensemble</h2></div><span class="mock-avatar">EP</span></div>
                                <div class="stat-grid"><div><small>SÉANCES CE MOIS</small><strong>128</strong><b class="positive">↑ 12,4%</b></div><div><small>TAUX DE PRÉSENCE</small><strong>94,8<sup>%</sup></strong><b class="positive">↑ 3,1%</b></div><div><small>À VALIDER</small><strong>08</strong><b class="pending">● À traiter</b></div></div>
                                <div class="chart-card"><div class="chart-title"><span>Présences par semaine</span><small>Septembre 2026⌄</small></div><div class="chart"><span class="chart-label label-one">100%</span><span class="chart-label label-two">75%</span><span class="chart-label label-three">50%</span><div class="chart-lines"></div><svg viewBox="0 0 440 130" role="img" aria-label="Courbe de progression des présences"><path d="M8 105 C46 96, 57 75, 91 84 S134 75, 166 65 S207 78, 241 55 S284 46, 312 51 S351 24, 389 38 S416 20, 434 14" fill="none" stroke="#18b6a4" stroke-width="4" stroke-linecap="round"/><circle cx="434" cy="14" r="5" fill="#f4c84b"/></svg><div class="chart-days"><span>S1</span><span>S2</span><span>S3</span><span>S4</span><span>S5</span></div></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="floating-note"><span>✓</span><div><strong>Séance validée</strong><small>Groupe DEV104 · à l'instant</small></div></div>
                </div>
            </section>

            <section class="feature-section" id="fonctionnalites">
                <div class="section-intro"><p class="eyebrow"><span></span> Une vision claire, chaque jour</p><h2>Tout ce qu'il faut pour<br><em>mieux décider.</em></h2><p>Des informations fiables, accessibles au bon moment, pour transformer le suivi administratif en véritable outil de pilotage.</p></div>
                <div class="feature-grid">
                    <article class="feature-card feature-main"><span class="feature-icon teal">⌁</span><p class="card-kicker">01 · SUIVI EN TEMPS RÉEL</p><h3>Les séances sous contrôle.</h3><p>Planifiez, consultez et suivez chaque séance avec une visibilité immédiate sur les groupes, modules et formateurs.</p><a href="{{ route('login') }}">Explorer les séances <span>→</span></a></article>
                    <article class="feature-card"><span class="feature-icon yellow">◷</span><p class="card-kicker">02 · PRÉSENCES</p><h3>La présence, sans friction.</h3><p>Centralisez les absences et gardez un historique exploitable pour accompagner chaque stagiaire.</p></article>
                    <article class="feature-card dark-card"><span class="feature-icon white">↗</span><p class="card-kicker">03 · AVANCEMENT</p><h3>Avancez avec une longueur d'avance.</h3><p>Mesurez la progression pédagogique et partagez une vision commune de la formation.</p></article>
                </div>
            </section>

            <section class="roles-section" id="roles">
                <div><p class="eyebrow"><span></span> Pensé pour votre quotidien</p><h2>Un même cap.<br><em>Des vues adaptées.</em></h2></div>
                <div class="role-list"><div class="role-row"><span class="role-number">01</span><strong>Formateurs</strong><span>Gérez vos séances, vos affectations et les présences de vos groupes.</span><span class="role-arrow">↗</span></div><div class="role-row"><span class="role-number">02</span><strong>Direction</strong><span>Validez les séances, suivez l'avancement et exportez vos synthèses.</span><span class="role-arrow">↗</span></div><div class="role-row"><span class="role-number">03</span><strong>Administration</strong><span>Structurez les filières, groupes, modules et équipes pédagogiques.</span><span class="role-arrow">↗</span></div></div>
            </section>

            <section class="cta-section"><div><p class="eyebrow"><span></span> Prêt à commencer ?</p><h2>Le bon suivi change<br><em>tout.</em></h2></div><a class="button button-light" href="{{ route('login') }}">Accéder à GestAbsence <span aria-hidden="true">↗</span></a></section>
        </main>

        <footer class="landing-footer"><span>© {{ date('Y') }} GestAbsence · OFPPT</span><span>Une plateforme pour une formation mieux pilotée.</span><a href="{{ route('login') }}">Connexion <span>↗</span></a></footer>
    </div>
</body>
</html>
