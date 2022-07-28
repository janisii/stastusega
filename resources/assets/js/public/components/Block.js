import React from 'react';
import GridItemEmpty from "./GridItemEmpty";
import GridItemImage from "./GridItemImage";
import GridItemTransparent from './GridItemTransparent';
import ReactCSSTransitionGroup from "react-addons-css-transition-group";
import Swiper from "react-id-swiper";

class Block extends React.Component {

    /**
     * Constructor
     * @param props
     */
    constructor(props) {
        super(props);
        this.state = {
            images: imageItems.filter(item => item.frame_id === this.props.frame.id),     /* global variable */
            rows: this.props.frame.rows,
            cols: this.props.frame.cols,
            imageWidth: this.props.width ? this.props.width : 185,
            grid: []
        };
        this.handleShowStory = this.handleShowStory.bind(this);
    }

    /**
     * Component Did Mount lifecycle
     */
    componentDidMount() {
        this.setGrid();
    }

    /**
     * Setting up grid elements
     */
    setGrid() {
        const grid = [];
        for (let i = 0; i < this.state.rows; i++) {
            for (let j = 0; j < this.state.cols; j++) {
                const itemFound = this.state.images.filter(item => item.cell_row === i && item.cell_col === j);
                if (itemFound.length > 0) {
                    grid.push(itemFound[0]);
                } else {
                    grid.push(null);
                }
            }
        }
        this.setState( { grid } );
    }

    /**
     * Show Story popup/modal in parent component
     * @param e
     */
    handleShowStory(e) {
        this.props.handleShowStory(e, e.target.dataset.storyId);
    }

    /**
     * Render component
     * @returns {*}
     */
    render() {
        return (
            <div className="block" key={this.props.frame.id}>
                {
                    this.state.grid.map( (item, idx) => {
                        if (item) {
                            const fragmentName = item.fragment_name ? item.fragment_name : '';
                            const imageUrl = `/i/${item.image_filename}?w=${this.state.imageWidth}&h=${this.state.imageWidth}&fit=crop`;
                            const imageBackgroundHex = item.image_background_hex;
                            const storyId = item.image_id;
                            return (
                                <ReactCSSTransitionGroup
                                    transitionName="fade"
                                    transitionAppear={true}
                                    transitionAppearTimeout={500}
                                    transitionEnterTimeout={500}
                                    transitionLeaveTimeout={300} key={idx}>
                                    <div className="item" key={idx} style={{'backgroundColor' : imageBackgroundHex}}>
                                        {
                                            this.props.showImages
                                                ?
                                                    <GridItemImage storyId={storyId} filename={imageUrl} title={fragmentName} handleClick={this.handleShowStory} />
                                                :
                                                <GridItemTransparent storyId={storyId} title={fragmentName} handleClick={this.handleShowStory} />
                                        }
                                    </div>
                                </ReactCSSTransitionGroup>
                            )
                        } else {
                            return (
                                <div className="item" key={idx}>
                                    <GridItemEmpty />
                                </div>
                            )
                        }
                    })
                }
            </div>
        );
    }
}

export default Block;