// === action types
export const CHANGE_INPUT_VALUE = 'CHANGE_INPUT_VALUE';
export const SET_ADRESS = 'SET_ADRESS';
export const TOGGLE_SIDEBAR = 'TOGGLE_SIDEBAR';
export const SET_BAKERY_LIST = 'SET_BAKERY_LIST';
export const REFRESH_BASKET = 'REFRESH_BASKET';
export const SET_CURRENT_BAKERY = 'SET_CURRENT_BAKERY';
export const SET_PRODUCTS_LIST = 'SET_PRODUCTS_LIST';
export const SET_ORDER = 'SET_ORDER';
export const SET_USER_IS_CONNECTED = 'SET_USER_IS_CONNECTED';

export const changeInputValue = (newValue) => ({
  type: CHANGE_INPUT_VALUE,
  value: newValue,
});

export const setAdress = (newValue) => ({
  type: SET_ADRESS,
  value: newValue,
});

export const toggleSidebar = (newValue) => ({
  type: TOGGLE_SIDEBAR,
  value: newValue,
});

export const setBakeryList = (newValue) => ({
  type: SET_BAKERY_LIST,
  value: newValue,
});

export const refreshBasket = (newValue) => ({
  type: REFRESH_BASKET,
  value: newValue,
});

export const setCurrentBakery = (newValue) => ({
  type: SET_CURRENT_BAKERY,
  value: newValue,
});

export const setProductsList = (newValue) => ({
  type: SET_PRODUCTS_LIST,
  value: newValue,
});

export const setOrder = (newValue) => ({
  type: SET_ORDER,
  value: newValue,
});
export const setUserIsConnected = (newValue) => ({
  type: SET_USER_IS_CONNECTED,
  value: newValue,
});

