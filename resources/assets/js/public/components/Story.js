import React, {Fragment} from 'react';
import { FacebookShareButton, FacebookIcon, TwitterShareButton, TwitterIcon, WhatsappShareButton, WhatsappIcon, EmailShareButton, EmailIcon } from 'react-share';
import { encodeHashId, removeTrailingSlash } from "../helpers";

class Story extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            storyItem: imageItems.filter(item => item.image_id === parseInt(props.id))[0],    // not the safest method
        };
        this.escFunction = this.escFunction.bind(this);
        this.addImageToMeta = this.addImageToMeta.bind(this);
    }

    /**
     * Lifecycle
     */
    componentDidMount(){
        document.addEventListener('keydown', this.escFunction, false);
        this.addImageToMeta();
    }

    componentWillUnmount(){
        document.removeEventListener('keydown', this.escFunction, false);
    }

    /**
     * Add meta image for FB share
     */
    addImageToMeta() {
        const story = this.state.storyItem;
        const path = `${document.location.origin}/i/${story.image_filename}`;
        const meta = document.querySelector('meta[name="og:image"]') || document.createElement('meta');
        meta.name='og:image';
        meta.content=path;
        document.querySelector('head').append(meta);
    }

    /**
     * Close story modal on esc
     * @param event
     */
    escFunction(event){
        if(event.keyCode === 27) {
            this.props.handleHideStory(new Event('click'));
        }
    }

    /**
     * Render
     * @returns {*}
     */
    render() {
        const story = this.state.storyItem;
        let fragmentName = story.fragment_name ? story.fragment_name : '';
        const fragmentGroup = story.fragment_course ? story.fragment_course : '';
        const fragmentStory = story.fragment_story ? story.fragment_story : '';
        const imageUrl = `/i/${story.image_filename}?w=600&h=600&fit=crop`;
        const imageBackgroundHex = story.image_background_hex;
        const fragmentLocation = story.fragment_location ? ', '+ story.fragment_location : null;
        if (!story.fragment_id) {
            fragmentName = story.image_filename_ori.replace(/\_/gi,  ' ').replace(/^[0-9]+/gi, '').replace(/\.JPG/gi, '');
        }
        const shareUrl = removeTrailingSlash(document.location.origin)+'/s/'+encodeHashId(story.image_id);
        const quote = `Aicinu izlasīt manu Ogres sākumskolas stāstu segas stāstu veltītu Latvijas simtgadei! ${fragmentName}. #stastusega #ogressakumskola`;
        return (
            <div className="story-overlay">
                <span className="close cursor" onClick={this.props.handleHideStory}>&times;</span>
                <div className="story-wrapper">
                    <div className="story-content">
                        <div className="image">
                            <div className="image-wrapper" style={{'backgroundColor': imageBackgroundHex}}>
                                <img src={imageUrl} alt={fragmentName} title={fragmentName} className="img-fluid" />
                            </div>
                        </div>
                        <div className="text">
                            <div className="author">{fragmentName}</div>
                            <div className="group d-flex align-items-center">
                                <div>
                                    {fragmentGroup}{fragmentLocation}
                                </div>
                                <div className="d-inline-flex flex-grow-1 justify-content-end">
                                    <FacebookShareButton url={shareUrl} quote={quote} className="share-button" className="mr-2">
                                        <FacebookIcon size={32} />
                                    </FacebookShareButton>
                                    <TwitterShareButton url={shareUrl} title={quote} className="share-button" className="mr-2">
                                        <TwitterIcon size={32} />
                                    </TwitterShareButton>
                                    <WhatsappShareButton url={shareUrl} title={quote} className="share-button" className="mr-2">
                                        <WhatsappIcon size={32} />
                                    </WhatsappShareButton>
                                    <EmailShareButton url={shareUrl} subject="Ogres sākumskolas stāstu segas fragments" body={quote}>
                                        <EmailIcon size={32} />
                                    </EmailShareButton>
                                </div>
                            </div>
                            <div className="body">
                                {fragmentStory.split('\r\n\r\n').map((item, key) => {
                                    return <p key={key}>{item.split('\r\n').map((i, k) => <Fragment key={k}>{i}<br /></Fragment>)}</p>
                                })}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Story;