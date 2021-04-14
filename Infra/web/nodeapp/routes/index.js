var express = require('express');
var router = express.Router();
var User = require('../models/database');

router.get('/', (req, res, next) => {
  res.redirect('/login');
});

router.get('/login', (req, res, next) => {
  res.render('login');
});

router.post('/login', (req, res, next) => {
  const username = req.body.username;
  const password = req.body.password;

  if (username && password) {
    const query = User.findOne({ username: username, password: password});

    query.exec((err, doc) => {
      if (err) return res.send({state: 'danger', msg: 'Error with database, please contact @xanhacks.'});

      if (doc !== null) {
        res.send({state: 'success', msg: 'You can validate this challenge with: Hero{NoSQL_1Nject1on_wAw_1597}'});
      } else if (username === "admin") {
        res.send({state: 'danger', msg: 'Wrong password !'});
      } else {
        res.send({state: 'danger', msg: 'Not match with this username !'});
      }
    })
  } else {
    res.send({state: 'danger', msg: 'You need to provide a username and a password !'});
  }
});


module.exports = router;