const postModel = require("../../models/modelFunctions/post.function");

module.exports.addNewPost = (req, res) => {
  let postInfo = req.body.userData;
  const userId = req.params.id;
  postInfo.userId = userId;
  postModel
    .addNewUser(postInfo)
    .then((succ) => {
      res.send({ status: true, save });
    })
    .catch((err) => {
      res.send({ status: false, err: err });
    });
};
module.exports.findAllPost = (req, res) => {
  postModel
    .findAllPost()
    .then((succ) => {
      res.send({ status: true, found: succ });
    })
    .catch((err) => {
      res.send({ status: false, err: err });
    });
};
module.exports.deleteSpecficPost = (req, res) => {
  postModel
    .deletePost(req.params.id)
    .then((succ) => {
      res.send({ status: true, delete: true });
    })
    .catch((err) => {
      res.send({ status: false, err: err });
    });
};
module.exports.updateSpecficPost = (req, res) => {
  const postData = req.body.postData;
  postModel
    .updatePost(userData, req.params.id)
    .then((succ) => {
      res.send({ status: true, save: true });
    })
    .catch((err) => {
      res.send({ status: false, err: err });
    });
};
module.exports.singlePost = (req, res) => {
  const postId = req.params.id
  postModel
    .findSinglePost(postId)
    .then((succ) => {
      res.send({ status: true, user: succ });
    })
    .catch((err) => {
      res.send({ status: false, err: err });
    });
};
