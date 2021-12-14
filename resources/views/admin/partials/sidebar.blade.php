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
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ url('img/menu-icon/dashboard.svg') }}" alt="">
                </div>
                <div class="nav_title">
                    <span>Contrats </span>
                </div>
            </a>
            <ul>
                <li><a href="index_2.html">Ajouter un contrat</a></li>
                <li><a href="index_2.html">En cours</a></li>
                <li><a href="index_3.html">Expirés</a></li>
  
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
              <li><a href="editor.html">Les souscripteurs</a></li>
              <li><a href="mail_box.html">Tous les bénéficiaires</a></li>
              <li><a href="editor.html">Les bénéficiaires Oumé</a></li>
              <li><a href="mail_box.html">Les bénéficiaires Ouéllé</a></li>
            </ul>
        </li>
        <li class="">
            <a   class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="{{ url('img/menu-icon/3.svg') }}" alt="">
            </div>
            <div class="nav_title">
                <span>Cas assistés</span>
            </div>
            </a>
            <ul>
              <li><a href="login.html">Liste des cas</a></li>
              <li><a href="resister.html">Créer un cas</a></li>
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
            <a   class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="{{ url('img/menu-icon/4.svg') }}" alt="">
            </div>
            <div class="nav_title">
                <span>Dépenses</span>
            </div>
            </a>
            <ul>
              <li><a href="admin_list.html">Ajouter une dépense</a></li>
              <li><a href="add_new_admin.html">Liste des dépenses</a></li>
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
            <a   class="has-arrow" href="#" aria-expanded="false">
              <div class="nav_icon_small">
                <img src="{{ url('img/menu-icon/5.svg') }}" alt="">
            </div>
            <div class="nav_title">
                <span>Demandes d'adhésion</span>
            </div>
            </a>
            <ul>
              <li><a href="user_list.html">A traiter</a></li>
              <li><a href="add_new_user.html">Valider</a></li>
              <li><a href="add_new_user.html">Rejeter</a></li>
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
              <li><a href="Basic_Elements.html">Droit d'inscription</a></li>
              <li><a href="Groups.html">Cotisation annuelle</a></li>
              <li><a href="Max_Length.html">Cotisation exceptionnelle</a></li>
              <li><a href="Max_Length.html">Traitement et kits d'inscription</a></li>
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
              <li><a href="dark_sidebar.html">Liste des administrateurs</a></li>
              <li><a href="light_sidebar.html">Créer un administrateur</a></li>
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
          <a href="Board.html" aria-expanded="false">
              <div class="nav_icon_small">
                  <img src="{{ url('img/menu-icon/9.svg') }}" alt="">
              </div>
              <div class="nav_title">
                  <span>Se déconnecter</span>
              </div>
          </a>
        </li>
        


      </ul>
</nav>