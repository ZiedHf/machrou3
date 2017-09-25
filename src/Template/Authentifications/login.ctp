<!--
you can substitue the span of reauth email for a input with the email and
include the remember me checkbox
-->

<header>
  <ul id="slide-out" class="side-nav fixed">
    <div class="row">
      <div class="col s12">
        <h4>Login</h4>
      </div>
      
      <?= $this->Form->create('auth', ['class' => 'col s12', 'inputContainer' => '{{content}}']); ?>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <?= $this->Form->input('email', ['id' => 'email', 'type' => 'email', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'class' => 'validate', 'required' => true]) ?>
            <label for="email"><?=__('Email')?></label>
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix">vpn_key</i>
            <?= $this->Form->input('password', ['id' => 'password', 'type' => 'password', 'templates' => ['inputContainer' => '{{content}}'], 'label' => false, 'required' => true, 'class' => 'validate']) ?>
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
          <?= $this->Form->button(__('Register').' '.'<i class="material-icons right">send</i>', ['class' => 'btn waves-effect blue', 'templates' => ['inputContainer' => '{{content}}']]); ?>
          </div>
        </div>
      </form>
    </div>
  </ul>
  <a href="#" data-activates="slide-out" class="waves-effect waves-light btn hide-on-large-only"><i class="material-icons">menu</i></a>
</header>
<main>
  <section>
      <div class="container">
        <div class="row">
          <div class="col s12">
              <h1 class="fontsforweb_fontid_70660 center">MACHROU3<sub>V1.0</sub></h1>
              <div class="row">
                <div class="col s12">
                    <?= $this->Flash->render('materialize') ?>
                </div>
                <div class="col s12">
                  <ul class="collapsible popout" data-collapsible="accordion">
                    <li>
                      <div class="collapsible-header"><i class="material-icons">trending_up</i>Gestion des projets</div>
                      <div class="collapsible-body"><span>Pour bien gérer vos projets et vos équipes, Machrou3 est la solution pratique, moderne et facile pour une vision claire !</span></div>
                    </li>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">view_comfy</i>Organisation</div>
                      <div class="collapsible-body"><span>Organiser les projets selon : Vos sociétés, départements, équipes, collaborateurs, clients.</span></div>
                    </li>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">pool</i>Profile et fichier</div>
                      <div class="collapsible-body"><span>Fiche de détails pour chaque projet et pour chaque entité.</span></div>
                    </li>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">account_circle</i>Système d'authorisation</div>
                      <div class="collapsible-body"><span>Compte pour chaque collaborateur et chaque client pour avoir l'accès (Consultation, Modification, ...) à <span class="bold">leurs</span> projets.</span></div>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="row">
                <div class="carousel carousel-slider center" data-indicators="true">

                  <div class="carousel-item blue lighten-3 white-text" href="#one!">
                    <h2>Pourquoi la gestion de projet est importante ?</h2>
                    <div class="card-panel grey lighten-5 z-depth-5">
                      <div class="row">
                        <div class="col s2">
                          <?= $this->Html->image('../machrou3_template/images/anonymous.jpg', ['class' => 'circle responsive-img', 'alt' => 'Machrou3']); ?>
                        </div>
                        <div class="col s10">
                          <span class="black-text">
                            <ul class="collection">
                              <li class="collection-item">La compression du cycle de vie des produits</li>
                              <li class="collection-item">La rapidité est devenue un avantage concurrentiel</li>
                              <li class="collection-item">La mondialisation de la concurrence</li>
                              <li class="collection-item">L’explosion de la connaissance</li>
                              <li class="collection-item">La réduction du personnel et des ressources</li>
                              <li class="collection-item">La consolidation et les restructurations</li>
                              <li class="collection-item">Les changements continus…</li>
                              <li class="collection-item">Et surtout les résultats que la gestion par projet rend possibles.</li>
                            </ul>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="carousel-item blue lighten-3 white-text" href="#three!">
                    <h2>Parce que les orientations stratégiques de l’entreprise se mettent en oeuvre sous forme de projets.</h2>
                    <div class="card-panel grey lighten-5 z-depth-5">
                      <div class="row">
                        <div class="col s2">
                          <?= $this->Html->image('../machrou3_template/images/anonymous.jpg', ['class' => 'circle responsive-img', 'alt' => 'Machrou3']); ?>
                        </div>
                        <div class="col s10">
                          <span class="black-text">
                            Le contexte : FBC (Faster, Better, Cheaper)
                            <ul class="collection">
                              <li class="collection-item">Innover de plus en plus et de plus en plus vite (F)</li>
                              <li class="collection-item">Faire de plus en plus de projets «payants» (B)</li>
                              <li class="collection-item">Plus souvent qu’autrement faire plus avec moins (C)</li>
                            </ul>
                            <h2>Les défis !</h2>
                            <ul class="collection">
                              <li class="collection-item">Être capable de voir clair dans tous ces projets.</li>
                              <li class="collection-item">S’assurer de choisir les bons projets et de bien les faire.</li>
                              <li class="collection-item">Bien faire les projets en utilisant nos ressources de façon de plus en plus efficace.</li>
                            </ul>

                            <a target="_blank" href="https://goo.gl/wnVYWF" class="waves-effect btn blue"><i class="material-icons right">link</i>Source</a>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
  </section>

  <section>
    <!-- Element Showed -->
    <div class="row bottom_desc">

      <a id="menu" class="waves-effect btn btn-floating blue" ><i class="material-icons">menu</i></a>

      <div class="tap-target blue darken-5" data-activates="menu">
        <div class="tap-target-content">
          <h5>Machrou3</h5>
          <p>Pour bien gérer vos projets et vos équipes, Machrou3 est la solution pratique, moderne et facile pour une vision claire !</p>
        </div>
      </div>
    </div>
  </section>
</main>
