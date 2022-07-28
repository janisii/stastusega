import React, {Fragment} from 'react';
import { NavLink } from 'react-router-dom';
import HomeIcon from '../icons/HomeIcon';
import SearchIcon from '../icons/SearchIcon';

class Header extends React.Component {
    render() {

        // extra option
        //<NavLink exact to="/about" className="link justify-content-center align-items-center d-flex toolbar ml-5" activeClassName="link-active">Par projektu</NavLink>

        return (
            <Fragment>
                <header>
                    <div className="container">
                        <div className="row">
                            <div className="col d-flex justify-content-start align-items-center toolbar">
                                <div className="d-none d-sm-inline-flex d-md-inline-flex d-lg-inline-flex d-xl-inline-flex">
                                    <NavLink exact to="/about" className="link justify-content-center align-items-center d-flex toolbar" activeClassName="link-active">Stāstu sega</NavLink>
                                    <NavLink exact to="/wall" className="link justify-content-center align-items-center d-flex toolbar ml-sm-2 ml-md-3 ml-lg-4 ml-xl-5" activeClassName="link-active">Simbolu siena</NavLink>
                                </div>
                            </div>
                            <div className="col d-flex justify-content-center align-items-center toolbar">
                                <NavLink exact to="/" className="link justify-content-center align-items-center d-flex toolbar pr-3 pl-3" activeClassName="link-active"><HomeIcon fill="#5e646c" width="25px" height="25px" /></NavLink>
                            </div>
                            <div className="col d-flex align-items-center justify-content-end toolbar">
                                <NavLink exact to="/q" className="link justify-content-center align-items-center d-flex toolbar pl-2 pr-3" activeClassName="link-active"><SearchIcon fill="#5e646c" width="25px" height="25px" /></NavLink>
                            </div>
                        </div>
                    </div>
                </header>
                <div className="d-block d-sm-none d-md-none d-lg-none d-xl-none">
                    <nav className="site-nav-xs">
                        <ul className="list-unstyled">
                            <li><NavLink exact to="/about" className="handset-link" activeClassName="handset-link-active">Stāstu sega</NavLink></li>
                            <li><NavLink exact to="/wall" className="handset-link" activeClassName="handset-link-active">Simbolu siena</NavLink></li>
                        </ul>
                    </nav>
                </div>
            </Fragment>
        );
    }
}

export default Header;