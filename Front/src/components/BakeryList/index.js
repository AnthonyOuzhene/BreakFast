// == Import
//import { AiOutlineHeart } from "react-icons/ai";
import './styles.scss';

import { GiWheat } from "react-icons/gi";
import { RiLeafLine } from "react-icons/ri";
import { SiLeaflet } from "react-icons/si";
import { TiHeartFullOutline } from "react-icons/ti";
import { TiLocation } from "react-icons/ti";

import { useSelector, useDispatch } from 'react-redux';
import Bakery from './Bakery';
/* import { bakeryList } from '../../data/data'; */
import { NavLink } from 'react-router-dom';
import { setAdress, setCurrentBakery } from '../../actions/actions';

import croissant from './Images/croissant.PNG';

const BakeryList = () => {
  const dispatch = useDispatch();
  const currentAdress = useSelector((state) => state.currentAdress);
  const bakeryList = useSelector((state) => state.bakeryList);
 /*  const dataFilter = bakeryList.filter(word => word.user.name === currentAdress); */
  const dataFilter = bakeryList.filter(word => word.address === currentAdress);


  return (
    <div className='bakery-list-page-bakery'>
      {dataFilter.length !== 0 ?
      <div className="bakery-list">
        <div className='bakery-list-wrapper-city'>
          <div className='bakery-list-wrapper-button'>
            <button className="bakery-list-adress-button" onClick={() => {
              const action = setAdress('');
              dispatch(action);
            }}>
              <TiLocation className='bakery-list-icon-location'/>
              <span>{currentAdress}</span>
              <span>Maintenant</span>
              </button>
          </div>
          <h2 className="bakery-list-title">
            Livraison dans la ville de {currentAdress}
          </h2>
        </div>
      
        <div className='bakery-list-wrapper-tags'>
          <div className="bakery-list-tags">
            <div className='bakery-list-filtres' >
              <h1 className='bakery-list-title-tags'>Filtrer par diététique</h1>
              <div className="bakery-list-tag">
                <div className="bakery-list-tag_label">
                  <TiHeartFullOutline />
                  <h2>Vegan</h2>
                </div>
                <div className="bakery-list-tag_label">
                  <GiWheat/>
                  <h2>Sans gluten</h2>
                </div> 
                <div className="bakery-list-tag_label">
                  <SiLeaflet />
                  <h2>Bio</h2>
                </div>
                <div className="bakery-list-tag_label">
                  <RiLeafLine />
                  <h2>Végétarien</h2>
                </div>
              </div>
            </div>
          </div>
          <div className="bakery-list-bakeries">
            <ul className="bakery-list-column">
              {dataFilter.map((item) => (
                <div className='navlink-bakery'>
                  <Bakery
                    key={Math.random().toString(36).substr(2, 9)}
                    id={item.id}
                    img={item.profile_img}
                    time={item.delivery_time}
                    name={item.name}
                    delivery_fees={item.delivery_fees}
                    rating={item.rating}
                    bakery={item}
                  />
                </div>
              ))}
            </ul>
          </div>
        </div>
      </div>
      :
      <div className='bakery-list-bakery-notfound'>
        <div className='bakery-list-wrapper'>
          <img src={croissant} />
          <h2>Aucune boulangerie trouvée</h2>
          <p>Nos services ne sont pas disponibles dans cette ville</p>
          <button className='bakery-list-btn-change-city' onClick={() => {
            const action = setAdress('');
            dispatch(action);
          }}>Changer de ville</button>
        </div>
      </div>
    }
    </div>
  );
}

// == Export
export default BakeryList;
