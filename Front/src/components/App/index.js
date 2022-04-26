// == Import
import './styles.scss';

import Header from '../Header';
import Footer from '../Footer';
import { Routes, Route, Link } from 'react-router-dom';
import React, { useEffect } from "react";
import ReactDOM from "react-dom";
import HomePage from 'src/components/HomePage';
import BakeryList from 'src/components/BakeryList';
import BakeryProducts from 'src/components/BakeryProducts';
import CheckoutBasket from 'src/components/CheckoutBasket';
import Checkout from 'src/components/Checkout';
import Contact from '../Contact';
import About from '../About';
import Blog from '../Blog';
import Formules from '../Formules';
import Log from 'src/components/Log';
import Page404 from 'src/components/Page404';
import { useSelector, useDispatch } from 'react-redux';
import { addToBasket, getBasket } from '../../basketFunctions';
import { refreshBasket, setBakeryList, setUserIsConnected } from '../../actions/actions';



// == Composant
const App = () => {
  const currentAdress = useSelector((state) => state.currentAdress);
  const sidebar = useSelector((state) => state.sidebar);
  const axios = require('axios');
  const dispatch = useDispatch();

  useEffect(() => {
    console.log('ajout du panier local storage au reducer')
    const basket = getBasket();
    dispatch(refreshBasket(basket));
    const token = sessionStorage.getItem('token');
    if(token){
      dispatch(setUserIsConnected(true))
    }
    else {
      dispatch(setUserIsConnected(false))
    }

    axios.get('http://anthonyouzhene-server.eddi.cloud/projet-04-break-fast-back/public/api/bakery')
    .then(function (response) {
     console.log(response.data);
     const action = setBakeryList(response.data);
     dispatch(action);
    })
    .catch(function (error) {
      // handle error
      console.log(error);
    })
  }, []);

  return (
    <div className={!sidebar ? "app" : "app menu-active"}>
      <Header />
      <Routes>
        <Route path="/login" element={<Log />} />
        <Route path="/" element={!currentAdress ? <HomePage /> : <BakeryList />} />
        <Route path="/checkout" element={<Checkout />} />
        <Route path="/basket" element={<CheckoutBasket />} />
        <Route path="/formules" element={<Formules />} />
        <Route path="/blog" element={<Blog />} />
        <Route path="/about" element={<About />} />
        <Route path="/contact" element={<Contact />} />
        {/* <Route path="/bakery/list" element={<BakeryList />} /> */}
        <Route path="/bakery/list/products" element={<BakeryProducts />} />
        <Route path="*" element={<Page404 />} />
      </Routes>
      {/* <Footer /> */}
    </div>
  );
}

// == Export
export default App;
