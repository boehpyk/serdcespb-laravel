import React, {useState, useEffect, useRef} from 'react';

const api = '/api/events';

const ConcertsCmp  = () => {

  const [hasError, setErrors] = useState(false);
  const [events, setEvents] = useState([]);
  const [loaded, setLoaded] = useState(false);

  let concertRef = [];

  useEffect(() => {
      getConcertList();
  }, []);

  async function getConcertList() {
      const res = await fetch(api);
      return res.json()
                .then(res => {
                    setEvents(res.data);
                    setLoaded(true);
                })
                .catch(err => setErrors(err));
  }


  const getConcertCardList = () => {
    return events.map((concert, i) => {
        const script = document.createElement("script");
        script.src = "https://radario.ru/scripts/widget/buy-button-widget.js";
        script.setAttribute('data-class', 'radarioButtonScript');
        script.setAttribute('data-radario-event-id', '547308');
        script.async = true;

        getConcertCard(concert, i);

        // concertBody.appendChild(script);

    });
  };

    const getConcertCard = ({ id, city, club_name, date_begin, meeting_url }, i) => {
        return (
            <li key={id} className='concert-list-item'>
                <div className='concert-card'>
                    <div className='concert-date'>
                        <span>{getDate(new Date(date_begin.replace(/ /g,"T")))}</span>
                    </div>
                    <div className='concert-body' ref={ (el) => concertRef.push(el) }>
                        <h3 className='concert-city'>{city}</h3>
                        <p className='concert-place'>{club_name}</p>
                    </div>
                </div>
            </li>
        );
    };

    const getDate = (date) => {
        return Intl.DateTimeFormat('ru-RU', { day: '2-digit', month: '2-digit', year: '2-digit' })
            .format(date)
            // .replace(/\.$/, '')
            .replace(/\//gi, '.')
            .padStart(6);
    };


  if (loaded) {
      return <ul className='concert-list'>{getConcertCardList()}</ul>;
  }
  else {
      return <div className='concert-list-preloader'><div className="preloader"></div></div>;
  }

};
export default ConcertsCmp;
