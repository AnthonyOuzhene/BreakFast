import './styles.scss';

import { NavLink } from "react-router-dom";
import croissant from './images/Pains-au-chocolat-brioché3.jpg';
import less from './images/minus.png';
import plus from './images/plus.png';
import React, { useState } from 'react';
import { addToBasket, changeQuantityBasket, findProduct, getBasket } from '../../../basketFunctions';
import { refreshBasket } from '../../../actions/actions';
import { useDispatch, useSelector } from 'react-redux';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

const Product = ({ id, img, name, price, notify }) => {
  const shoppingBasketList = useSelector((state) => state.shoppingBasket)
  console.log(shoppingBasketList)
  const productsList = useSelector((state) => state.productsList);

  const dispatch = useDispatch();
  const currentProduct = findProduct(id, productsList);

  const [count, setCount] = useState(0);
  if (count < 0) {
    setCount(0)
  }

  let laClasseBtn = "bakery-add-to-basket-0"
  if (count > 0){
    laClasseBtn = "bakery-add-to-basket"
  }

  return (
    <li className="bakery-product">
      <img className="bakery-product_img" src={img} />
      <div className="bakery-product-info">
        <div>
          <h2 className="bakery-product_name">{name}</h2>
          <p className="bakery-product_price">{price}€</p>
        </div>
        <div className="bakery-product-quantity">
          {count}
          <div className="bakery-math">
            <img
              onClick={() => setCount(count - 1)}
              className="less"
              src={less}
              alt="signe moins"
            />
            <img
              onClick={() => setCount(count + 1)}
              className="plus"
              src={plus}
              alt="signe plus"
            />
          </div>
        </div>
      </div>

      <div>
        <button className={laClasseBtn} onClick={() => {
          changeQuantityBasket(currentProduct, count);
          let basket = getBasket();
          dispatch(refreshBasket(basket));
          notify();
        }}>
          Ajouter au panier
        </button>
      </div>
    </li>
  );
}

export default Product;
