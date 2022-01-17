<nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="index-2.html"><img src="{{ url('img/logo1.png') }}" style="" alt=""></a>
        <a class="small_logo" href="index-2.html"><img src="{{ url('img/mini_logo.png') }}" alt=""></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="">
          <a  href="{{ route('admin.index') }}" aria-expanded="false">
            <div class="nav_icon_small">
              <img src="{{ url('img/menu-icon/7.svg') }}" alt="">
          </div>
          <div class="nav_title">
              <span>Tableau de bord</span>
          </div>
          </a>
        </li>
        <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="{{ url('img/menu-icon/5.svg') }}" alt="">
            </div>
            <div class="nav_title">
                <span>Adhésions</span>
            </div>
            </a>
            <ul>
              <li><a href="{{ route("admin.adhesion.importation") }}">Importation</a></li>
              <li><a href="{{ route("admin.adhesion.create") }}">Ajout</a></li>
              <li><a href="{{ route("client.adhesion.liste") }}">A traiter</a></li>
              <li><a href="{{ route('admin.adhesion.valider.liste') }}">Validées</a></li>
              <li><a href="{{ route('admin.adhesion.rejeter.liste') }}">Rejetées</a></li>
            </ul>
        </li>
        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ url('img/menu-icon/2.svg') }}" alt="">
                </div>
                <div class="nav_title">
                    <span>Adhérents </span>
                </div>
            </a>
            <ul>
              <li><a href="{{ route('admin.adherent.index') }}">Les souscripteurs</a></li>
              <li><a href="{{ route('admin.beneficiaires.index') }}">Tous les bénéficiaires</a></li>
              <li><a href="editor.html">Les souscripteurs Oumé</a></li>
              <li><a href="mail_box.html">Les souscripteurs Ouéllé</a></li>
            </ul>
        </li>
        <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="{{ url('img/menu-icon/4.svg') }}" alt="">
            </div>
            <div class="nav_title">
                <span>Cotisations</span>
            </div>
            </a>
            <ul>
              <li><a href="admin_list.html">Annuelles</a></li>
              <li><a href="add_new_admin.html">Exceptionnelles</a></li>
            </ul>
        </li>
        <li class="">
          <a  href="{{ route('admin.assistance.index') }}" aria-expanded="false">
            <div class="nav_icon_small">
              <img src="{{ url('img/menu-icon/3.svg') }}" alt="">
          </div>
          <div class="nav_title">
              <span>Cas assistés</span>
          </div>
          </a>
        </li>
        {{-- <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="{{ url('img/menu-icon/3.svg') }}" alt="">
            </div>
            <div class="nav_title">
                <span>Cas assistés</span>
            </div>
            </a>
            <ul>
              <li><a href="{{ route('admin.assistance.index') }}">Liste des cas</a></li>
              <li><a href="{{ route('admin.assistance.create') }}">Créer un cas</a></li>
            </ul>
        </li> --}}
        
        <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="{{ url('img/menu-icon/4.svg') }}" alt="">
            </div>
            <div class="nav_title">
                <span>Dépenses</span>
            </div>
            </a>
            <ul>
              <li><a href="{{ route('admin.depense.create') }}">Ajout</a></li>
              <li><a href="{{ route('admin.depense.index') }}">Liste</a></li>
            </ul>
        </li>
        
        <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="{{ url('img/menu-icon/11.svg') }}" alt="">
            </div>
            <div class="nav_title">
                <span>Campagnes</span>
            </div>
            </a>
            <ul>
              <li><a href="module_setting.html">Email</a></li>
              <li><a href="role_permissions.html">Sms</a></li>
            </ul>
        </li>
        
        <li class="">
            <a  class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{ url('img/menu-icon/8.svg') }}" alt="">
              </div>
              <div class="nav_title">
                  <span>Configurations</span>
              </div>
            </a>
            <ul>
              <li><a href="{{ route('admin.droit-inscription.index') }}">Droit d'inscription</a></li>
              <li><a href="{{ route('admin.montant-cotisation-annuelle.index') }}">Cotisation annuelle</a></li>
              <li><a href="{{ route('admin.montant-cotisation-exceptionnelle.index') }}">Cotisation exceptionnelle</a></li>
              <li><a href="{{ route('admin.montant-kit.index') }}">Traitement et kits d'inscription</a></li>
            </ul>
        </li>
        <li class="">
            <a  class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{ url('img/menu-icon/11.svg') }}" alt="">
              </div>
              <div class="nav_title">
                  <span>Administrateurs</span>
              </div>
            </a>
            <ul>
              <li><a href="light_sidebar.html">Ajout</a></li>
              <li><a href="dark_sidebar.html">Liste</a></li>
            </ul>
        </li>
        <li class="">
            <a  class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{ url('img/menu-icon/12.svg') }}" alt="">
              </div>
              <div class="nav_title">
                  <span>Mon compte</span>
              </div>
            </a>
            <ul>
              <li><a href="Minimized_Aside.html">Mes informations</a></li>
              <li><a href="empty_page.html">Modifier mon mot de passe</a></li>
            </ul>
        </li>
        <li class="">
          
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form-sidebar').submit();" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{ url('img/menu-icon/9.svg') }}" alt="">
              </div>
              <div class="nav_title">
                  <span>Se déconnecter</span>
              </div>
          </a>
          <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
</nav>