# HackBoard
HackBoard | Personalized dashboard created by some Side Project Hackers

[![Build Status](https://travis-ci.org/SPHackers/HackBoard.svg?branch=master)](https://travis-ci.org/SPHackers/HackBoard)
[![Style Status](https://styleci.io/repos/65632396/shield)](https://styleci.io/repos/65632396/shield)

## Contributing

Please feel free to submit any PR that improves or add new features. This project is also for your learning. You can start learning a new technology or a new language by simply using it by creating a new widget to the board and pushing it to this repo.

**Note:** All PRs must be **PSR-2 compliant**, and must pass all *Style-CI* and *Travis-CI* validations before merging.

## How to contribute and install a dev instance
 
 1. Fork the original repository in your personal space
  ![Fork](http://i.imgur.com/YwMGlwg.png)

 2. Clone the repository on your machine
 
  `git clone git@github.com:<YOUR USERNAME>/HackBoard.git`

 3. Install backend packages with Composer

  `composer install`
  
 4. Run the database creation and migration scripts

  `php artisan migrate`
  
 5. If you're on a Mac, launch Laravel Valet (if not, configure laravel on your local webserver)
 
  `valet install` and `valet park`
 
 6. When you're done with a change, create a Pull Request toward original repo's `master` branch
