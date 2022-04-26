import { productBakery15 } from "./data/data";

export const saveBasket = (basket) => {
    localStorage.setItem('shoppingBasket', JSON.stringify(basket));
}
export const getBasket = () => {
    let basket = localStorage.getItem('shoppingBasket')
    if (basket == null) {
        return [];
    }
    else {
        return JSON.parse(basket);
    }
}

export const addToBasket = (product) => {
    let basket = getBasket();
    let foundProduct = basket.find(p => p.id == product.id);
    if (foundProduct != undefined) {
        foundProduct.quantity++;
    }
    else {
        product["quantity"] = 1;
        console.log(product);
        basket.push(product);
    }
    saveBasket(basket);
}

export const removeFromBasket = (product) => {
    let basket = getBasket();
    let foundProduct = basket.find(p => p.id == product.id);
    if (foundProduct != undefined) {
        if (foundProduct.quantity > 0) {
            foundProduct.quantity--;
        }
        else {
            basket = basket.filter(p => p.id != product.id);
            console.log(basket)
        }
    }
    saveBasket(basket)   

}

export const changeQuantityBasket = (product, quantity) => {
    let basket = getBasket();
    let foundProduct = basket.find(p => p.id == product.id);
    if (foundProduct != undefined) {
        if (quantity == 0) {
            basket = basket.filter(p => p.id != product.id);
        }
        else {
            foundProduct.quantity = quantity;
        }
    }
    else{
        product["quantity"] = quantity;
        console.log(product);
        basket.push(product);
    }
    
    saveBasket(basket);
}

export const findProduct = (productId, productsList) => {
    return productsList.find(p => p.id == productId);
}

export const deliveryTime = (time) => {
    let now = new Date();
    let heure = now.getHours();
    let minutes = now.getMinutes() + time;
    if (minutes > 59) {
      heure = heure + 1;
      if(heure < 10){
        heure = '0' + heure;
    }
      minutes = time + now.getMinutes() - 59;
      if(minutes < 10){
          minutes = '0' + minutes;
      }
    }
    return `${heure}h${minutes}`
}