// == Import
import React, { useState } from "react";
import remove from "./images/remove.png";
import verifie from "./images/verifie.png";
import { NavLink } from "react-router-dom";
import { useSelector } from "react-redux";
import { BsArrowLeft } from "react-icons/bs";
import "./styles.scss";
import { deliveryTime } from "../../basketFunctions";

// == Composant
const Checkout = () => {
  const currentAdress = useSelector((state) => state.currentAdress);
  const order = useSelector((state) => state.order);
  console.log(order);
  if (order.length === 0) {
    console.log("test");
    window.location.replace("/basket");
  }
  const time = deliveryTime(order.currentBakery.delivery_time)
  console.log(time)
  const shoppingBasketList = useSelector((state) => state.shoppingBasket);
  console.log(shoppingBasketList);

  const currentBakery = JSON.parse(localStorage.getItem("currentBakery"));
  console.log(currentBakery);

  const [popUp, setpopUp] = useState("nopopup");

  return (
    <div className="Checkout-Checkout">
      <div className="wrapper-checkout">
        <NavLink to='/basket'>
          <BsArrowLeft className="btn-back"/>
        </NavLink>
        
        <div className="Checkout-infoPerso">
          <div className="Checkout-verif">vérification d'adresse :</div>
          <div className="Checkout-ville">{currentBakery.address}</div>
        
            <input type="radio" name="demo2" class="demo2 demoyes" id="demo2-a" checked/>
            <label for="demo2-a">Click and Collect</label>
            <input type="radio" name="demo2" class="demo2 demono" id="demo2-b" />
            <label for="demo2-b">Livraison à domicile</label>
        
          <ul className="Checkout-commande" >
            {order.productsList.map((item) => (
              <li className="element-list-products">
                <span>{item.quantity} x {item.name}</span>
                <span>{(item.quantity * item.price).toFixed(2)} €</span>
              </li>
            ))}
          </ul>
        </div>
        <div className="Checkout-droite">
          <div className="wrapper-total">
            <div className="Checkout-Total">
              <div className="Checkout-ligne">Commande</div>
              <div className="Checkout-ligne">Frais de livraison</div>
              <div className="Checkout-Finalprice">Total</div>
            </div>
            <div className="Checkout-Totaux">
              <div className="Checkout-ligne">{(order.totalPrice).toFixed(2)}€</div>
              <div className="Checkout-ligne">{(order.currentBakery.delivery_fees).toFixed(2)}€</div>
              <div className="Checkout-Finalprice">{(order.totalPrice + order.currentBakery.delivery_fees).toFixed(2)}€</div>
            </div>
          </div>
          <button className="Checkout-btnPayer" onClick={() => {
            setpopUp("popup")
            }}>
            PAYER
          </button>
        </div>
      </div>
        

      <div className="lapopup">
        <div className={popUp}>
          <div className="Checkout-btnEchap">
            <NavLink to="/checkout" onClick={() => setpopUp("nopopup")}>
              x
            </NavLink>
          </div>
          <div className="Checkout-confirmation">État de la commande : </div>
          <div className="Checkout-etat">Confirmé !</div>
          <div>
            <img className="Checkout-icone" src={verifie} alt="verifie" />
          </div>
          <div className="Checkout-heure">commande prête pour :</div>
          <div className='Checkout-time' >{time}</div>
        </div>
      </div>
    </div>
  );
};

// == Export
export default Checkout;

//Mathys
