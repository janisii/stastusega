import React, {Fragment} from 'react';

const OnOffSwitch = (props) => {
    return (
        <div className="d-flex align-items-center">
            <div className="onoffswitch">
                <input type="checkbox" name="onoffswitch" id={props.id} className="onoffswitch-checkbox" checked={props.checked} onChange={props.handleChange} />
                <label className="onoffswitch-label" htmlFor={props.id}>
                    <span className="onoffswitch-inner"></span>
                    <span className="onoffswitch-switch"></span>
                </label>
            </div>
            <div className="onoffswitch-title ml-2 mr-3" onClick={props.handleChange}>{props.title}</div>
        </div>
    );
};

export default OnOffSwitch;