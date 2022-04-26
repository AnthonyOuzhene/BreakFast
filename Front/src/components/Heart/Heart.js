import { BsSuitHeart } from "react-icons/bs";

import './styles.scss';

const Heart = () => {

  return (
    <div className="heart" >
      <label>
        <input
          type="radio"
          name="like"
        />
        <BsSuitHeart className="heart" />
      </label>
    </div>
  );
};

export default Heart;
