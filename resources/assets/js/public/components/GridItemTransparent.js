import React from 'react';
const GridItemTransparent = props => <img src="/images/transparent.png" alt={props.title} title={props.title}  className="img-fluid grid-item-image" data-story-id={props.storyId} onClick={props.handleClick} />;
export default GridItemTransparent;