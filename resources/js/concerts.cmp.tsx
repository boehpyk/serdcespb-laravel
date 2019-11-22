import React from 'react';

interface Concert {
  city: string;
  place: string;
  link: string;
  date: Date;
}

export class ConcertsCmp extends React.Component {
  render() {
    return <ul className='concert-list'>{this.getConcertCardList()}</ul>;
  }

  private getConcertCardList(): React.ReactNode {
    return this.getConcertList().map((concert, i) => this.getConcertCard(concert, i));
  }

  private getConcertCard({ city, place, date, link }: Concert, i: number): JSX.Element {
    return (
      <li key={i} className='concert-list-item'>
        <a className='concert-card' href={link}>
          <div className='concert-date'>
            <span>{this.getDate(date)}</span>
          </div>
          <div className='concert-body'>
            <h3 className='concert-city'>{city}</h3>
            <p className='concert-place'>{place}</p>
          </div>
        </a>
      </li>
    );
  }

  private getConcertList(): Concert[] {
    return [
      {
        city: 'Санк-Петербург',
        date: new Date(),
        place: 'Tochka',
        link: 'http://zeropeople.ru',
      },
      {
        city: 'Москва',
        date: new Date(),
        place: 'Luzhniki',
        link: 'http://zeropeople.ru',
      },
      {
        city: 'Ekaterinburg',
        date: new Date(),
        place: 'Tochka',
        link: 'http://zeropeople.ru',
      },
      {
        city: 'Санк-Петербург',
        date: new Date(),
        place: 'Tochka',
        link: 'http://zeropeople.ru',
      },
      {
        city: 'Москва',
        date: new Date(),
        place: 'Luzhniki',
        link: 'http://zeropeople.ru',
      },
      {
        city: 'Ekaterinburg',
        date: new Date(),
        place: 'Tochka',
        link: 'http://zeropeople.ru',
      },
      {
        city: 'Ekaterinburg',
        date: new Date(),
        place: 'Tochka',
        link: 'http://zeropeople.ru',
      },
    ];
  }

  private getDate(date: Date): string {
    return Intl.DateTimeFormat(void 0, { day: 'numeric', month: 'short' })
      .format(date)
      .replace(/\.$/, '')
      .padStart(6);
  }
}
