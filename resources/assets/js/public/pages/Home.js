import React, {Fragment} from 'react';
import Swiper from 'react-id-swiper';
import Title from '../components/Title';
import Block from '../components/Block';
import Story from '../components/Story';
import OnOffSwitch from '../components/OnOffSwitch';
import { getScreenWidth, decodeHashId } from '../helpers';

class Home extends React.Component {

    constructor(props) {
        super(props);

        let defaultSlidesPerView = getScreenWidth() > 1024 ? 5 : 3;

        this.state = {
            frames: frames,     /* global variable */
            isStoryActive: false,
            storyId: null,
            defaultSlidesPerView: defaultSlidesPerView,
            slidesPerView: defaultSlidesPerView,
            rebuildOnUpdate: false,
            showImages: true,
            smallDevice: getScreenWidth() <= 640,
            searchByHash: this.props.match.params.hashid !== undefined ? decodeHashId(this.props.match.params.hashid) : null
        };

        this.handleShowStory = this.handleShowStory.bind(this);
        this.handleHideStory = this.handleHideStory.bind(this);
        this.handleOneSlidePerView = this.handleOneSlidePerView.bind(this);
        this.handleHideImages = this.handleHideImages.bind(this);
    }

    /**
     * ComponentDidMount
     * @param prevProps
     * @param prevState
     */
    componentDidMount(prevProps, prevState) {
        if (this.state.searchByHash !== null) {
            this.setState({storyId: this.state.searchByHash, isStoryActive: true});
        }
    }

    /**
     * Handle to show story
     * @param e
     * @param id
     */
    handleShowStory(e, id) {
        e.preventDefault();
        this.setState({ isStoryActive : true, storyId: parseInt(id)});
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
     * Handle switch to change from 1 to 5 slides
     * @param e
     */
    handleOneSlidePerView(e) {
        if (this.state.slidesPerView === 1) {
            this.setState({slidesPerView: this.state.defaultSlidesPerView, rebuildOnUpdate: true});
        } else {
            this.setState({slidesPerView: 1, rebuildOnUpdate: true});
        }
        // Hacking up the Swiper
        setTimeout(function () {
            this.setState({rebuildOnUpdate: false});
        }.bind(this), 500)
    }

    /**
     * Handle hide images
     * @param e
     */
    handleHideImages(e) {
        this.setState({showImages: !this.state.showImages});
    }

    /**
     * Render
     * @returns {*}
     */
    render() {

        let params = {
            slidesPerView: this.state.slidesPerView,
            spaceBetween: 0,
            grabCursor: true,
            breakpoints: {
                1024: {
                    slidesPerView: this.state.slidesPerView,
                    spaceBetween: 0,
                },
                640: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                },
            }
        };

        // update slider params
        if (this.state.slidesPerView < this.state.defaultSlidesPerView || getScreenWidth() <= 1024) {
            params = Object.assign(
                {
                    pagination: {
                        el: '.swiper-pagination',
                        type: 'progressbar',
                    }
                }
            , params);
        }

        return (
            <Fragment>
                <div className="container">
                    <div className="row">
                        <div className="col">
                            <Title name="Ogres sākumskolas stāstu sega" />
                            <div className="d-flex justify-content-start mb-2 mb-xl-3 mb-lg-3 mb-md-3 mb-sm-3">
                                {this.state.smallDevice ? null : <OnOffSwitch id="slidesSwitch" title="Rādīt visas slejas" checked={this.state.slidesPerView > 1} handleChange={this.handleOneSlidePerView} /> }
                                <OnOffSwitch id="imagesSwitch" title="Rādīt bildes" checked={this.state.showImages} handleChange={this.handleHideImages} />
                            </div>
                            <Swiper {...params} rebuildOnUpdate={this.state.rebuildOnUpdate}>
                                {this.state.frames.map(frame => <div key={frame.id}><Block key={frame.id} frame={frame} showImages={this.state.showImages} handleShowStory={this.handleShowStory} /></div>)}
                            </Swiper>
                            { this.state.isStoryActive && this.state.storyId ? <Story id={this.state.storyId} handleHideStory={this.handleHideStory} /> : null }
                        </div>
                    </div>
                </div>
            </Fragment>
        );
    }
}

export default Home;