import {
  CHANGE_INPUT_VALUE,
  TOGGLE_SIDEBAR,
  SET_ADRESS,
  SET_BAKERY_LIST,
  REFRESH_BASKET,
  SET_CURRENT_BAKERY,
  SET_PRODUCTS_LIST,
  SET_ORDER,
  SET_USER_IS_CONNECTED,
} from '../actions/actions';

const initialState = {
  inputAdress: '',
  currentAdress: '',
  currentBakery: '',
  sidebar: false,
  bakeryList: [],
  productsList: [],
  shoppingBasket: [],
  order: [],
  userIsConnected: false,
};

const inputReducer = (state = initialState, action = {}) => {
  // console.log(`le reducer a reçu une action ${action.type}`);

  switch (action.type) {
    case CHANGE_INPUT_VALUE:
      return {
        ...state,
        inputAdress: action.value,
      };
    case SET_ADRESS:
      return {
        ...state,
        currentAdress: action.value,
      };
    case TOGGLE_SIDEBAR:
      return {
        ...state,
        sidebar: action.value,
      };
    case SET_BAKERY_LIST:
      return {
        ...state,
        bakeryList: action.value,
      };
    case REFRESH_BASKET:
      return {
        ...state,
        shoppingBasket: action.value,
      };
    case SET_CURRENT_BAKERY:
      return {
        ...state,
        currentBakery: action.value,
      };
    case SET_PRODUCTS_LIST:
      return {
        ...state,
        productsList: action.value,
      };
    case SET_ORDER:
      return {
        ...state,
        order: action.value,
      };
    case SET_USER_IS_CONNECTED:
    return {
      ...state,
      userIsConnected: action.value,
    };

    default:
      return state;
  }
};

export default inputReducer;
