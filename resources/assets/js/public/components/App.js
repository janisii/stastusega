import React, {Fragment} from 'react';
import Header from './Header';
import Main from './Main';
import Footer from './Footer';

class App extends React.Component {
    render() {
        return (
            <Fragment>
                <Header />
                <Main />
                <Footer name="Ogres sākumskola &copy; 2018"/>
            </Fragment>
        );
    }
}

export default App;