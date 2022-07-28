import React, {Fragment} from 'react';
import Title from '../components/Title';
import WallSymbol from '../components/WallSymbol';
import imageWall from '../images/wall.jpg';
import imageWallFlag from '../images/wall-01-flag.png';
import imageWallAnthem from '../images/wall-02-anthem.png';
import imageWallCoat from '../images/wall-03-coat.png';
import imageWallMonument from '../images/wall-04-monument.png';
import imageWallBird from '../images/wall-05-bird.png';
import imageWallInsect from '../images/wall-06-insect.png';
import imageWallAmber from '../images/wall-07-amber.png';
import imageWallFlower from '../images/wall-08-flower.png';
import imageWallLinden from '../images/wall-09-linden.png';
import imageWallOak from '../images/wall-10-oak.png';
import imageWallRiver from '../images/wall-11-river.png';
import imageWallSolstice from '../images/wall-12-solstice.png';
import imageWallBelt from '../images/wall-13-belt.png';

class About extends React.Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col">
                        <Title name="Ogres sākumskolas simbolu siena" />
                        <img src={imageWall} alt="Ogres sākumskolas simbolu siena" className="img-fluid mt-2 mb-4" />
                    </div>
                </div>
                <div className="row">
                    <div className="col-md-6"><WallSymbol src={imageWallFlag} title="Latvijas valsts karogs" /></div>
                    <div className="col-md-6"><WallSymbol src={imageWallAnthem} title="Latvijas valsts himna" /></div>
                    <div className="col-md-6"><WallSymbol src={imageWallCoat} title="Latvijas valsts ģērbonis" /></div>
                    <div className="col-md-6"><WallSymbol src={imageWallMonument} title="Latvijas neatkarības simbols — Brīvības piemineklis" /></div>
                    <div className="col-md-6"><WallSymbol src={imageWallBird} title="Latvijas nacionālais putns — Baltā cielava" /></div>
                    <div className="col-md-6"><WallSymbol src={imageWallInsect} title="Latvijas kukainis — Divpunktu mārīte" /></div>
                    <div className="col-md-6"><WallSymbol src={imageWallAmber} title="Latvijas minerāls — Dzintars" /></div>
                    <div className="col-md-6"><WallSymbol src={imageWallFlower} title="Latvijas zieds — pīpene" /></div>
                    <div className="col-md-6"><WallSymbol src={imageWallLinden} title="Latvijas koks — Liepa" /></div>
                    <div className="col-md-6"><WallSymbol src={imageWallOak} title="Latvijas koks — Ozols" /></div>
                    <div className="col-md-6"><WallSymbol src={imageWallRiver} title="Latvijas likteņupe — Daugava" /></div>
                    <div className="col-md-6"><WallSymbol src={imageWallSolstice} title="Latvijas svētki ar simbolisku nozīmi — Vasaras saulgrieži" /></div>
                    <div className="col-md-6"><WallSymbol src={imageWallBelt} title="Latviešu spēka zīmes — Lielvārdes josta" /></div>
                </div>
            </div>
        );
    }
}

export default About;