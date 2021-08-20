const postModel = require("../../models/modelFunctions/post.function");

module.exports.addNewPost = (req, res) => {
  let postInfo = req.body.postData;
  const userId = req.params.id;
  postInfo.userId = userId;
  postModel
    .addNewPost(postInfo)
    .then((succ) => {
      res.send({ status: true, save });
    })
    .catch((err) => {
      res.send({ status: false, err: err });
    });
};
module.exports.findAllPost = (req, res) => {
  const pageNum = req.params.pageNo;
  const sortingTechniqueFromUser = Number(req.params.sort);
  let page = 0;
  let sortingTechnique = 0;
  if (pageNum && !Number.isNaN(pageNum) && pageNum > 0) {
    page = pageNum;
  }
  if (
    sortingTechniqueFromUser &&
    !Number.isNaN(sortingTechniqueFromUser) &&
    sortingTechniqueFromUser >= 0
  ) {
    sortingTechnique = sortingTechniqueFromUser;
  }
  postModel
    .findAllPost(page, sortingTechnique)
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
  const postId = req.params.id;
  postModel
    .findSinglePost(postId)
    .then((succ) => {
      res.send({ status: true, post: succ });
    })
    .catch((err) => {
      res.send({ status: false, err: err });
    });
};
