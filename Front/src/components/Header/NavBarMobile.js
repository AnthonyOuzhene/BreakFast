// == Import
import './styles.scss';
import { NavLink } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';
import { toggleSidebar } from 'src/actions/actions';
import * as BsIcons from "react-icons/bs";
import BurgerCakeIcon from './images/pancakes-icon-vector-newcolor-layers-no.png'
import { setUserIsConnected } from '../../actions/actions';
import CupConnected from './images/cup-full-connected.png'
import CupNotConnected from './images/cup-empty-notconnected.png'


// == Composant
const NavBarMobile = () => {
  // Récupère état side menu
  const userIsConnected = useSelector((state) => state.userIsConnected);
  const sidebar = useSelector((state) => state.sidebar);
  const dispatch = useDispatch();

  return (
    <nav className={sidebar ? 'navbar navbar-mobile active' : 'navbar navbar-mobile'}>
      <div className="wrapper-menu">
        <h2 className="title-side-menu">BreakFast</h2>
        
      </div>
      <ul className="list-navbar">
        <li><NavLink to='/' className="nav-link nav-link-home" onClick={() => {
          // Ferme le menu au clic sur le lien
          const action  = toggleSidebar(!sidebar);
          dispatch(action);
        }}><BsIcons.BsFillHouseDoorFill  className="icon-sidebar"/>Accueil</NavLink></li>
        <li><NavLink to='/formules' className="nav-link nav-link-formulas" onClick={() => {
          // Ferme le menu au clic sur le lien
          const action  = toggleSidebar(!sidebar);
          dispatch(action);
        }}><BsIcons.BsFillCalendarFill  className="icon-sidebar"/>Formules</NavLink></li>
        <li><NavLink to='/blog' className="nav-link nav-link-blog" onClick={() => {
          // Ferme le menu au clic sur le lien
          const action  = toggleSidebar(!sidebar);
          dispatch(action);
        }}><BsIcons.BsFillBookFill  className="icon-sidebar"/>Blog</NavLink></li>
        <li><NavLink to='/about' className="nav-link nav-link-about" onClick={() => {
          // Ferme le menu au clic sur le lien
          const action  = toggleSidebar(!sidebar);
          dispatch(action);
        }}><BsIcons.BsInfoCircleFill  className="icon-sidebar"/>A propos</NavLink></li>
        <li><NavLink to='/contact' className="nav-link nav-link-contact" onClick={() => {
          // Ferme le menu au clic sur le lien
          const action  = toggleSidebar(!sidebar);
          dispatch(action);
        }}><BsIcons.BsEnvelopeFill  className="icon-sidebar"/>Contact</NavLink></li>
        {userIsConnected ? (
              <li><a href='http://anthonyouzhene-server.eddi.cloud/projet-04-break-fast-back/public/index.php/backoffice' className='nav-link'>BackOffice</a></li>
            ) : (<p className='rien-dedans' ></p>)}
      </ul>
      <div className="box-account">
      {userIsConnected ? (
        <NavLink to='/login'  onClick={() => {
          // Ferme le menu au clic sur le lien
          const action  = toggleSidebar(!sidebar);
          dispatch(action);
          sessionStorage.removeItem('token');
                dispatch(setUserIsConnected(false));
        }}>
          <img src={CupConnected} className="icon-account" />
           <span className="text-btn-déco">Déconnexion</span>



          </NavLink>

          ) : (
            <NavLink to='/login'  onClick={() => {
              // Ferme le menu au clic sur le lien
              const action  = toggleSidebar(!sidebar);
              dispatch(action);
            }}>
              <img src={CupNotConnected} className="icon-account"/>
              <span className="text-btn-co">Connexion</span>
              </NavLink>
          )}
        
       
      </div>
    </nav>
  );
}

// == Export
export default NavBarMobile;
