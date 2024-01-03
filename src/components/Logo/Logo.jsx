import style from "./style.module.css";
export function Logo({ image, title, subtitle }) {
  return (
    <>
      <div className={style.container}>
        <img src={image} className={style.image}/>
        <span className={style.title}>{title}</span>
      </div>
      <span className={style.subtitle}>{subtitle} </span>
    </>
  );
}
