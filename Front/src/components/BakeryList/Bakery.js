// == Import
import './styles.scss';
import StarRating from 'src/components/StarRating/StarRating';
import { NavLink } from 'react-router-dom';
import { setCurrentBakery } from '../../actions/actions';
import { useDispatch } from 'react-redux';
import { addDelFavoris, getFavoris } from '../../favorisFunctions';
import { useState } from 'react';
import WhiteHeart from './Images/like-button-white.png';
import RedHeart from './Images/like-button-red.png';
// == Composant
const Bakery = ({ id, img, time, name, delivery_fees, rating, bakery }) => {
    console.log(id);
    const dispatch = useDispatch();
    const favorisList = getFavoris();

    const [isFav, setIsFav] = useState(favorisList.find(i => i == id) ? true : false);  

    const [coeur, setcoeur] = useState(false);

    const HeartToggle = () => {
      setcoeur(!coeur)
    }
    
    return (
      <div className="bakery-list-bakery">
        <NavLink
          to="/bakery/list/products"
          className="link-image"
          onClick={() => {
            const action = setCurrentBakery(bakery);
            dispatch(action);
            localStorage.setItem("currentBakery", JSON.stringify(bakery));
          }}
        >
          <img className="bakery-list-bakery__img" src={img} alt="croissant" />
        </NavLink>
        <p className="bakery-list-bakery-deliverytime">{time} min</p>
        <div className="bakery-list-bakery-infos">
          <div>
            <h2 className="bakery-list-bakery-name">{name}</h2>
            <p className="bakery-list-bakery-deliverycost">
              Frais de livraison : {delivery_fees}€
            </p>
            <div className="bakery-list-rating">
              <StarRating value={rating} />
            </div>
          </div>
          {isFav == false ? (
            <img
              className="bakery-list-icone"
              onClick={() => {
                HeartToggle()
                addDelFavoris(id);
                setIsFav(true);
              }}
              src={WhiteHeart}
            />
          ) : (
            <img
              className="bakery-list-icone"
              onClick={() => {
                HeartToggle()
                addDelFavoris(id);
                setIsFav(false);
              }}
              src={RedHeart}
            />
          )}
        </div>
      </div>
    );
}

// == Export
export default Bakery;
