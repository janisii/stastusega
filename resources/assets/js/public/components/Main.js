import React, { Fragment } from 'react';
import { Switch, Route, Redirect } from 'react-router-dom';
import Home from '../pages/Home';
import About from '../pages/About';
import Search from '../pages/Search';
import Wall from '../pages/Wall';

class Main extends React.Component {
    render() {
        return (
        <Fragment>
            <Switch>
                <Route exact path='/' component={Home} />
                <Route path='/about' component={About} />
                <Route path='/wall' component={Wall} />
                <Route path='/s/:hashid' component={Home} />
                <Route path='/q' component={Search} />
                <Redirect from='*' to='/' />
            </Switch>
        </Fragment>
        )
    }
}

export default Main;