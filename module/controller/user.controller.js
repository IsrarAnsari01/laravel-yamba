const userModel = require("../../models/modelFunctions/user.function");
// const jwt = require("jsonwebtoken");
// const dotenv = require("dotenv");
// dotenv.config();
module.exports.addNewUser = (req, res) => {
  const userData = req.body.userData;
  userModel
    .addNewUser(userData)
    .then((succ) => {
      res.send({ status: true, save: true, userInfo: succ });
    })
    .catch((err) => {
      res.send({ status: false, err: err });
    });
};
module.exports.findAllUser = (req, res) => {
  userModel
    .findAllUser()
    .then((succ) => {
      res.send({ status: true, found: succ });
    })
    .catch((err) => {
      res.send({ status: false, err: err });
    });
};
module.exports.deleteSpecficUser = (req, res) => {
  userModel
    .deleteUser(req.params.id)
    .then((succ) => {
      res.send({ status: true, delete: true });
    })
    .catch((err) => {
      res.send({ status: false, err: err });
    });
};
module.exports.updateSpecficUser = (req, res) => {
  const userData = req.body.userData;
  userModel
    .updateUser(userData, req.params.id)
    .then((succ) => {
      res.send({ status: true, save: true });
    })
    .catch((err) => {
      res.send({ status: false, err: err });
    });
};
module.exports.loginUser = (req, res) => {
  const userData = req.body.userData;
  userModel
    .loginUser(userData)
    .then((succ) => {
      //   const user = succ;
      //   const userId = user.id;
      //   const token = jwt.sign({ id: userId }, process.env.TOKEN_SECRET_KEY, {
      //     expiresIn: "50m",
      //   });
      //   res.send({ status: true, token: token });
      res.send({ status: true, user: succ });
    })
    .catch((err) => {
      res.send({ status: false, err: err });
    });
};
module.exports.getAllPostsOfThisUser = (req, res) => {
  userModel
    .findAllPosts(req.params.id)
    .then((succ) => {
      res.send({ status: true, posts: succ });
    })
    .catch((err) => {
      res.send({ status: false, err: err });
    });
};
