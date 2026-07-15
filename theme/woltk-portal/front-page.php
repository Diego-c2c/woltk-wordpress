<?php get_header(); ?>
<section class="hero">
  <div class="wrap">
    <h1>Bienvenue sur le portail WoTLK</h1>
    <p>Retrouve les actualités du serveur, le guide de démarrage, les téléchargements utiles et l’accès à la création de compte.</p>
    <div class="actions">
      <a class="btn btn-primary" href="<?php echo esc_url(home_url('/telechargement/')); ?>">Télécharger le jeu</a>
      <a class="btn btn-secondary" href="<?php echo esc_url(home_url('/creer-compte/')); ?>">Créer un compte</a>
    </div>
  </div>
</section>
<section class="section">
  <div class="wrap grid">
    <article class="card">
      <h3>Démarrage rapide</h3>
      <p>Commence par créer ton compte, télécharge le client compatible puis suis le guide pas à pas.</p>
    </article>
    <article class="card">
      <h3>Guide du serveur</h3>
      <p>Retrouve les étapes de connexion, les réglages utiles et les informations de progression.</p>
    </article>
    <article class="card">
      <h3>Espace joueur</h3>
      <p>Prépare le futur lien entre WordPress et la création de compte AzerothCore.</p>
    </article>
  </div>
</section>
<?php get_footer(); ?>
