import React from 'react';

const Header: React.FC = () => {
    return (
        <header>
            <div className="container mx-auto px-4 py-4 flex justify-between items-center">
                <h1 className="text-2xl font-bold text-blue-600">MyLandingPage</h1>
                <nav> 
                    <ul className="flex space-x-6">
                        <li>
                            <a href="#features" className="text-gray-700 ">
                                Features
                            </a>
                        </li>
                        <li>
                            <a href="#about" className="text-gray-700 hover:text-blue-600">
                                About
                            </a>
                        </li>
                        <li>
                            <a href="#contact" className="text-gray-700 hover:text-blue-600">
                                Contact
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
    );
};

export default Header;