import React from 'react';

const Nav = () => {
  return (
    <>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="./">
            Event
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  aria-current="page"
                  href="./main.php"
                >
                  Home
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="./login.html">
                  Login
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./register.html">
                  Register
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./user.html">
                  User
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </>
  );
};

export { Nav };
