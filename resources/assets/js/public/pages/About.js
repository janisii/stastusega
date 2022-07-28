import React, {Fragment} from 'react';
import Title from "../components/Title";

class About extends React.Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col">
                        <Title name="Ogres sākumskolas stāstu sega" />
                        <p className="text-center"><em>Ogres sākumskolas projekts “Stāstu sega Latvijai” — dāvana Latvijas simtgadē!</em></p>
                        <h3 className="mt-3 mb-3" style={{fontSize: '20px'}}>Mērķis</h3>
                        <p>Stiprināt Ogres sākumskolas izglītojamo  un viņu ģimeņu  piederības sajūtu un mīlestību pret savu zemi, īstenojot radošas aktivitātes  kultūrvides veidošanā, apvienojot tradicionālās vērtības un prasmes, to laikmetīgās izpausmes un tehnoloģiju iespējas, sagaidot Latvijas 100 gadi.</p>
                        <h3 className="mt-3 mb-3" style={{fontSize: '20px'}}>Ideja</h3>
                        <p>Stāstu segas idejas pamatā ir mūsu kopīgais devums un mīlestība Latvijai.</p>
                        <p>Izveidot dāvanu Latvijai simtgadē — </p>
                        <ol>
                            <li>lielizmēra tekstilmozaīkas segu <em>(patchwork quilt)</em>,</li>
                            <li>grāmatu,</li>
                            <li>digitalizēt stāstus,</li>
                            <li>izveidot Latvijas simtgadei veltītu simbolu sienu.</li>
                        </ol>
                        <h3 className="mt-3" style={{fontSize: '20px'}}>Norise</h3>
                        <p><em>Norises laiks no 2017. gada septembra  līdz 2018. gada novembrim.</em></p>
                        <ul>
                            <li>Stāstu segas gabaliņus — neliela izmēra kvadrātus — izgatavoja Ogres sākumskolas skolēnu ģimenes, pedagogi,  tehniskie darbinieki, Ogres pilsētas līdzpilsoņi (kopā vairāk kā 360 kvadrātiņus). Katrs kvadrātiņš vēsta par katru no mums! Tas tika iešūts  lielajā segā! Radoši,  koši un krāsaini, mīlestības  pilni, cienot un godinot mūsu senčus, dzimteni, ģimeni, skolu un klasi! Tekstilmozaīkas sega  iegūs simbolisku nozīmi, tā tiks mantota no paaudzes paaudzē. Auduma gabaliņi glabās  atmiņas par nozīmīgiem Latvijas un Ogres iedzīvotāju dzīves notikumiem.</li>
                            <li>Ģimenes, dzimtas, mājas  stāsti  apkopoti  un informācija iekļauta  interaktīvā multimediālā prezentācijā un grāmatā. Izveidotā grāmata liecinās par mūsu tautas likteņiem ar cerību, ka tas nākotnē radīs  pozitīvas emocijas.</li>
                            <li>Valsts simtgades sienas un simbolu izveidošana.</li>
                        </ul>
                        <p>Liels paldies darba grupai par pozitīvismu, atsaucību,  atbildību un mīlestību pret veikto darbu!</p>
                    </div>
                </div>
            </div>
        );
    }
}

export default About;