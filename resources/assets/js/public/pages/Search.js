import React from 'react';
import Title from '../components/Title';
import GridItemImage from '../components/GridItemImage';
import Story from '../components/Story';
import ReactCSSTransitionGroup from 'react-addons-css-transition-group';

class Search extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            images: imageItems,
            isStoryActive: false,
            storyId: null,
        };
        this.handleFilterByQuery = this.handleFilterByQuery.bind(this);
        this.handleShowStory = this.handleShowStory.bind(this);
        this.handleHideStory = this.handleHideStory.bind(this);
        this.handleClearQuery = this.handleClearQuery.bind(this);
        this.showResults = this.showResults.bind(this);
    }

    /**
     * Filter by query
     * @param e
     */
    handleFilterByQuery(e) {
        const regex = new RegExp(e.target.value, 'gi');
        const images = imageItems.filter(item => {
            if (item.fragment_id !== null) {
                return item.fragment_name.match(regex) || item.fragment_course.match(regex)
            } else if (item.fragment_id === null) {
                return item.image_filename_ori.match(regex);
            } else {
                return false;
            }
        });
        this.setState({ images: images});
    }

    /**
     * Clear search query
     * @param e
     */
    handleClearQuery(e) {
        document.querySelector('#q').value = '';
        this.setState({ images: imageItems});
    }

    /**
     * Handle to show story
     * @param e
     */
    handleShowStory(e) {
        e.preventDefault();
        this.setState({ isStoryActive : true, storyId: parseInt(e.target.dataset.storyId)});
    }

    /**
     * Handle to hide story
     * @param e
     */
    handleHideStory(e) {
        e.preventDefault();
        const searchByHash = this.state.searchByHash;
        this.setState( { isStoryActive: false, storyId: null, searchByHash: null});
        if (searchByHash) {
            this.props.history.push('/');
        }
    }

    /**
     * Show results
     * @returns {*}
     */
    showResults() {
        const items = this.state.images.map((item, idx) => {
            const fragmentName = item.fragment_name ? item.fragment_name : '';
            const imageUrl = `/i/${item.image_filename}?w=$50&h=50&fit=crop`;
            const imageBackgroundHex = item.image_background_hex;
            const storyId = item.image_id;

            return (
                <div className="search-item" style={{backgroundColor:imageBackgroundHex}} key={idx}>
                    <GridItemImage storyId={storyId} filename={imageUrl} title={fragmentName} handleClick={this.handleShowStory} />
                </div>
            )
        });

        return (
            <ReactCSSTransitionGroup
                component="div"
                className="d-flex flex-row flex-wrap"
                transitionName="fade"
                transitionAppear={true}
                transitionAppearTimeout={500}
                transitionEnterTimeout={500}
                transitionLeaveTimeout={300}>
                {items}
            </ReactCSSTransitionGroup>
        )
    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col">
                        <Title name="Ogres sākumskolas stāstu sega" />
                        <form className="mt-0 mt-sm-3">
                            <div className="d-flex">
                                <label htmlFor="q" className="mr-3 col-form-label">Meklēt stāstu:</label>
                                <div className="flex-grow-1 position-relative">
                                    <input type="text" id="q" className="form-control" placeholder="atslēgvārds..." onChange={this.handleFilterByQuery} autoComplete="off" />
                                    <span className="clear-search" onClick={this.handleClearQuery}>&times;</span>
                                </div>
                            </div>
                        </form>
                        <div className="mt-0 mt-sm-3">
                            {
                                this.state.images.length === 0
                                    ?
                                        <p>Pēc izvēlētā atslēgvārda stāsts nav atrasts!</p>
                                    :
                                        this.showResults()
                            }
                        </div>
                        { this.state.isStoryActive && this.state.storyId ? <Story id={this.state.storyId} handleHideStory={this.handleHideStory} /> : null }
                    </div>
                </div>
            </div>
        );
    }
}

export default Search;