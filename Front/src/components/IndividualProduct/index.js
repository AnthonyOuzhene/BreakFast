// == Import
import './styles.scss';

import less from './images/minus.png';
import plus from './images/plus.png';
import React, { useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { changeCountBasket, refreshBasket } from '../../actions/actions';
import { addToBasket, findProduct, getBasket, removeFromBasket } from '../../basketFunctions';
import { BsPlusCircle, BsDashCircle } from "react-icons/bs";


// == Composant
const IndividualProduct = ({id, img,  name, prix, count}) => {
  const dispatch = useDispatch();
  const productsList = JSON.parse(localStorage.getItem('productsList'))
  console.log(productsList)

  let TotalIndividuel = Math.round((count * prix) * 100) / 100;
  console.log(id)

  const currentProduct = findProduct(id, productsList);
  console.log(count)

  return (
    <div className="Basket-product">
      <img className="Basket-imgProduit" src={img} alt="img-croissant" />
      <div className="Basket-info">
        <div className="Basket-individual-product-name">{name}</div>
        <div className="Basket-individual-product-total-price">
          {TotalIndividuel}€
        </div>
      </div>
      <div className="Basket-quantity">
        {count}
        <div className="math">
          <BsDashCircle
            onClick={() => {
              removeFromBasket(currentProduct);
              let basket = getBasket();
              dispatch(refreshBasket(basket));
            }}
            className="less"
            src={less}
            alt="signe moins"
          />
          <BsPlusCircle
            onClick={() => {
              addToBasket(currentProduct);
              let basket = getBasket();
              dispatch(refreshBasket(basket));
            }}
            className="plus"
            src={plus}
            alt="signe plus"
          />
          
        </div>
      </div>
    </div>
  );};


// == Export
export default IndividualProduct;



//Mathys
