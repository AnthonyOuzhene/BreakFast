// == Import
import './styles.scss';
import { useSelector, useDispatch } from 'react-redux';
import { toggleSidebar } from 'src/actions/actions';
import { NavLink } from 'react-router-dom';
import { useState } from 'react';
// Images
import BreakFastLogo from './images/breakfast-logo-light.png'
import ShoppingBasket from './images/painier-original-color-breakfast.png'
import CupNotConnected from './images/cup-empty-notconnected.png'
import CupConnected from './images/cup-full-connected.png'
import petitPancake from './images/pancakes-icon-vector-newcolor-no.png'
import grandPancake from './images/pancakes-icon-vector-newcolor-layers-no.png'

// Composants
import NavBarDesktop from './NavBarDesktop';
import NavBarMobile from './NavBarMobile';
import { setAdress, setUserIsConnected } from '../../actions/actions';

const Header = () => {
  // Récupère état side menu
  const userIsConnected = useSelector((state) => state.userIsConnected);
  console.log(userIsConnected);
  const sidebar = useSelector((state) => state.sidebar);
  const shoppingBasketList = useSelector((state) => state.shoppingBasket)
  console.log(shoppingBasketList.length)
  const dispatch = useDispatch();


  const [pastille, setpastille] = useState(false);



  if ( shoppingBasketList.length === 0 ){
    if (pastille != false){
      setpastille(false);
    }
    
  }
  else {
    if (pastille != true){
      setpastille(true);
    }
  }


  const [pancake, setPancake] = useState(false);

  const classToggle = () => {
    setPancake(!pancake)
  }
  return (
    <header className="header">
      <div className="header-mobile">
        <NavBarMobile />
        <div className="header-buttons">
          <div className="box-img">
            <img src={`${pancake ? grandPancake : petitPancake}`}
              // className={
              //   sidebar
              //     ? "bars icon btn-menu-burger active"
              //     : "bars icon btn-menu-burger"
              // }
              onClick={() => {
                classToggle();
                const action = toggleSidebar(!sidebar);
                dispatch(action);
              }}
            >
            </img>
          </div>
          <NavLink to="/" className="box-img"></NavLink>
          <div className="box-img">
            <NavLink to="/basket" className="wrapper-basket-icon">
              <img src={ShoppingBasket}></img>
              <span
                className={
                  pastille
                    ? "pastille-basket-mobile"
                    : "no-pastille-basket-mobile"
                }
              >
                {shoppingBasketList.length}
              </span>
            </NavLink>
          </div>
        </div>
        <h1 className="slogan">Votre petit dej en un clic</h1>
      </div>

      <div className="header-laptop">
        <div className="header-buttons">
          <div className="box-logo-slogan">
            <NavLink to="/">
              <img src={BreakFastLogo} className="logo-breakfast"  onClick={() => {
              const action = setAdress('');
              dispatch(action);
            }}/>
            </NavLink>
            <h1 className="slogan">Votre petit dej en un clic</h1>
          </div>
          <div className="buttons-basket-log">
            <NavLink to="/basket" className="box-button-header nav-link">
              <div className="wrapper-basket-icon">
                <img
                  src={ShoppingBasket}
                  className="buttons-header icon-basket"
                />
                <span
                  className={
                    pastille ? "pastille-basket" : "no-pastille-basket"
                  }
                >
                  {shoppingBasketList.length}
                </span>
              </div>
              <span className="span-btn">Panier</span>
            </NavLink>
            {userIsConnected ? (
              <button className="box-button-header button-logout" onClick={() => {
                sessionStorage.removeItem('token');
                dispatch(setUserIsConnected(false));
              }}>
                <img
                  src={CupConnected}
                  className="buttons-header icon-cuplog"
                />
                <span className="span-btn">Déconnexion</span>
              </button>
            ) : (
              <NavLink to="/login" className="box-button-header nav-link">
                <img
                  src={CupNotConnected}
                  className="buttons-header icon-cuplog"
                />
                <span className="span-btn">Connexion</span>
              </NavLink>
            )}
          </div>
        </div>
        <NavBarDesktop />
      </div>
    </header>
  );
}

// == Export
export default Header;
