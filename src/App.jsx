import { useEffect, useState } from "react";
import { TVShowAPI } from "./api/tv-show";
import "./global.css";
import style from "./style.module.css";
import { BACKDROP_BASE_URL } from "./config";
import { TVShowDetail } from "./components/TVShowDetail/TVShowDetail";
import { Logo } from "./components/Logo/Logo";
import { TVShowList } from "./components/TVShowList/TVShowList";

import logo from "./assets/images/logo.png";
import { SearchBar } from "./components/SearchBar/SearchBar";

export function App() {
  const [currentTVShow, setCurrentTVShow] = useState();
  const [recommendationList, setRecommendationList] = useState([]);

  async function fetchPopulars() {
    try {
      const populars = await TVShowAPI.fetchPopulars();
      if (populars.length > 0) {
        setCurrentTVShow(populars[0]);
      }
    } catch (error) {
      alert("Erreur durant la recherche des séries populaires");
    }
  }

  async function fetchRecommendations(tvShowId) {
    try {
      const recommendations = await TVShowAPI.fetchRecommendations(tvShowId);
      if (recommendations.length > 0) {
        setRecommendationList(recommendations.slice(0, 10));
      }
    } catch (error) {
      alert("Erreur durant la recherche des séries recommendées");
    }
  }

  useEffect(() => {
    fetchPopulars();
  }, []);

  useEffect(() => {
    if (currentTVShow) {
      fetchRecommendations(currentTVShow.id);
    }
  }, [currentTVShow]);

  function setCurrentTvShowFromRecommendation(tvShow) {
    alert(JSON.stringify(tvShow));
  }

  async function searchTVShow(tvShowName) {
    try {
      const searchResponse = await TVShowAPI.fetchByTitle(tvShowName);
      if (searchResponse.length > 0) {
        setCurrentTVShow(searchResponse[0]);
      }
    } catch (error) {
      alert("Erreur durant la recherche de la série");
    }
  }

  return (
    <div
      className={style.main_container}
      style={{
        background: currentTVShow
          ? `linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)), url("${BACKDROP_BASE_URL}${currentTVShow.backdrop_path}") no-repeat center / cover`
          : "black",
      }}
    >
      <div className={style.header}>
        <div className="row">
          <div className="col-4">
            <Logo
              image={logo}
              title="Watowatch"
              subtitle="find a show you may like"
            />
          </div>
          <div className="col-sm-12 col-md-4">
            <SearchBar onSubmit={searchTVShow} />
          </div>
        </div>
      </div>
      <div className={style.tv_show_detail}>
        {currentTVShow && <TVShowDetail tvShow={currentTVShow} />}
      </div>

      <div className={style.recommended_shows}>
        {recommendationList && recommendationList.length > 0 && (
          <TVShowList
            onClickItem={setCurrentTVShow}
            tvShowList={recommendationList}
          />
        )}
      </div>
    </div>
  );
}
