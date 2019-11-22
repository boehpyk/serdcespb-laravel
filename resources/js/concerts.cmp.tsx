import React, {useState, useEffect} from 'react';

interface Concert {
  city        : string;
  club_name   : string;
  meeting_url : string;
  date_begin  : Date;
  date_end    : Date;
}

const api:string = '/api/events';

const ConcertsCmp  = () => {

  const [hasError, setErrors] = useState(false);
  const [events, setEvents] = useState([]);

  useEffect(() => {
      getConcertList();
  }, []);

  async function getConcertList(): Promise<void> {
    console.log('fetch called!');
      const res = await fetch(api);
      return res.json()
                .then(res => setEvents(res.data))
                .catch(err => setErrors(err));
  }


  const getConcertCardList = (): React.ReactNode => {
    return events.map((concert: Concert, i:number) => getConcertCard(concert, i));
  };

    const getConcertCard = ({ city, club_name, date_begin, meeting_url }: Concert, i: number): JSX.Element => {
        return (
            <li key={i} className='concert-list-item'>
                <a className='concert-card' href={meeting_url}>
                    <div className='concert-date'>
                        <span>{getDate(new Date(date_begin))}</span>
                    </div>
                    <div className='concert-body'>
                        <h3 className='concert-city'>{city}</h3>
                        <p className='concert-place'>{club_name}</p>
                    </div>
                </a>
            </li>
        );
    };

    const getDate = (date: Date): string => {
        return Intl.DateTimeFormat(void 0, { day: 'numeric', month: 'numeric', year: '2-digit' })
            .format(date)
            // .replace(/\.$/, '')
            .replace(/\//gi, '.')
            .padStart(6);
    };


  return <ul className='concert-list'>{getConcertCardList()}</ul>;

};
export default ConcertsCmp;
