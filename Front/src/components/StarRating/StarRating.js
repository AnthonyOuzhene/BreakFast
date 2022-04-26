import React, { useState, useEffect } from "react";
import { FaStar } from "react-icons/fa";

import './styles.scss';

const StarRating = ({value}) => {
  const [rating, setRating] = useState(null);
  
  useEffect(() => {
    setRating(value)
  }, [])

  return (
    <div>
      {[...Array(5)].map((star, i) => {
        const ratingValue = i++;
        //console.log(ratingValue);
        const test = Math.random().toString(36).substr(2, 9)

        return (
          <label className="stare" >
            <input
            
              type="radio"
              name="rating"
              key={test}
              // TODO key="test", faire boucle dans l'index
              value={ratingValue}
              /* onClick={() => setRating(ratingValue)} */
            />
            <FaStar className="star" color={ratingValue <= rating ? "#C68B59" : "#402218"} />
          </label>
        );
      })}
    </div>
  );
};

export default StarRating;
