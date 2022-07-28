import React from 'react';
const GridItemImage = props => <img src={props.filename} alt={props.title} title={props.title} data-story-id={props.storyId} className="img-fluid grid-item-image" onClick={props.handleClick} />;
export default GridItemImage;