import React from 'react';
import styles from '../styles.css';

const WallSymbol = props => {
    return (
        <div className="row wall-symbol">
            <div className="col-md-8 wall-symbol-text d-flex justify-content-center align-items-center justify-content-md-end mb-md-0 mb-2 text-center text-md-right">
                {props.title}
            </div>
            <div className="col-md-4 wall-symbol-image d-flex justify-content-center align-items-center justify-content-md-center mb-md-0 mb-4">
                <img src={props.src} alt={props.title} title={props.title} class="img-fluid" />
            </div>
        </div>
    )
};
export default WallSymbol;