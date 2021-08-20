const db = require("../index");
const { Op } = require("sequelize");
module.exports.addNewPost = async (postData) => {
  try {
    var user = await db.Post.create(postData);
  } catch (err) {
    console.log(err);
  }
  return user;
};
module.exports.deletePost = async (postId) => {
  try {
    var delUser = await db.Post.destroy({
      where: {
        id: postId,
      },
    });
  } catch (err) {
    console.log(err);
  }
  return delUser;
};

// Pagination Concept
module.exports.findAllPost = async (page, sortingTechnique) => {
  const limit = 2;
  let technique = ["id", "ASC"];
  if ((sortingTechnique == 0)) {
    technique = ["id", "ASC"];
  } else if ((sortingTechnique == 1)) {
    technique = ["id", "DESC"];
  } else if ((sortingTechnique == 2)) {
    technique = ["title", "ASC"];
  } else if ((sortingTechnique == 3)) {
    technique = ["title", "DESC"];
  } else if ((sortingTechnique == 4)) {
    technique = [sequelize.fn("max", sequelize.col("body")), "DESC"];
  }
  try {
    var allPost = await db.Post.findAndCountAll({
      limit: limit,
      offset: page * limit, // Skip Two records
      order: [technique],
    });
  } catch (err) {
    console.log(err);
  }
  const totalPage = Math.ceil(allPost.count / limit);
  return { allPost, totalPage };
};
module.exports.updatePost = async (postInfo, id) => {
  try {
    var updatedPost = await db.Post.update(postInfo, {
      where: {
        id: id,
      },
    });
  } catch (err) {
    console.log(err);
  }
  return updatedPost;
};

module.exports.findSinglePost = async (id) => {
  try {
    var singlePost = await db.Post.findOne({
      where: {
        id: id,
      },
      include: db.User,
    });
  } catch (err) {
    console.log(err);
  }
  return singlePost;
};
