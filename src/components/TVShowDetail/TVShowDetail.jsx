import style from "./style.module.css";
import { FiveStarRating } from "../FiveStarRating/FiveStarRating";

export function TVShowDetail({ tvShow }) {
  const rating = tvShow.vote_average / 2;
  return (
    <div>
      <div className={style.title}>{tvShow.original_title}</div>
      <div className={style.rating_container}>
        <FiveStarRating rating={rating} />
        <div className={style.rating}>{rating}</div>
      </div>
      <div className={style.overview}>{tvShow.overview} </div>
    </div>
  );
}
