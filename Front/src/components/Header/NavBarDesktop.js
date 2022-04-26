// == Import
import './styles.scss';
import { NavLink } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

// == Composant
const NavBarDesktop = () => {
  
  const userIsConnected = useSelector((state) => state.userIsConnected);


  return (
    <nav className="navbar navbar-desktop">
      <ul className="list-navbar">
        <li><NavLink to='/' className="nav-link">Accueil</NavLink></li>
        <li className="link-formulas">
          <div>
            <NavLink to="/formules" className="nav-link link-component-formulas">Formules</NavLink>
            <div className="dropdown-content">
              <ul>
                <li><NavLink to='/formulas/lover' className="link-component">P'tit dej en amoureux</NavLink></li>
                <li><NavLink to='/formulas/business' className="link-component">Entreprise</NavLink></li>
                <li><NavLink to='/formulas/birthday' className="link-component">Anniversaire</NavLink></li>
              </ul>
              </div>
          </div></li>
        <li><NavLink to='/blog' className="nav-link">Blog</NavLink></li>
        <li><NavLink to='/about' className="nav-link">A propos</NavLink></li>
        <li><NavLink to='/contact' className="nav-link">Contact</NavLink></li>

        {userIsConnected ? (
              <li><a href='http://anthonyouzhene-server.eddi.cloud/projet-04-break-fast-back/public/index.php/backoffice' className='nav-link'>BackOffice</a></li>
            ) : (<p className='rien-dedans' ></p>)}

      </ul>
    </nav>
  );
}

// == Export
export default NavBarDesktop;


