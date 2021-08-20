const db = require("../index");
module.exports.addNewUser = async (UserData) => {
  try {
    var User = await db.User.create(UserData);
  } catch (err) {
    console.log(err);
  }
  return User;
};
module.exports.deleteUser = async (UserId) => {
  try {
    var delUser = await db.User.destroy({
      where: {
        id: UserId,
      },
    });
  } catch (err) {
    console.log(err);
  }
  return delUser;
};
module.exports.findAllUser = async () => {
  try {
    var allUser = await db.User.findAll();
  } catch (err) {
    console.log(err);
  }
  return allUser;
};
module.exports.updateUser = async (UserInfo, id) => {
  try {
    var updatedUser = await db.User.update(UserInfo, {
      where: {
        id: id,
      },
    });
  } catch (err) {
    console.log(err);
  }
  return updatedUser;
};

module.exports.loginUser = async (UserInfo) => {
  try {
    var loginUser = await db.User.findOne({
      where: {
        email: UserInfo.email,
        password: UserInfo.password,
        role: UserInfo.role,
      },
    });
  } catch (err) {
    console.log(err);
  }
  return loginUser;
};

module.exports.findSingleUser = async (User) => {
  try {
    var singleUser = await db.User.findOne({
      where: {
        id: User.id,
      },
    });
  } catch (err) {
    console.log(err);
  }
  return singleUser;
};

module.exports.findAllPosts = async (UserId) => {
  try {
    var loggedUser = await db.User.findOne({ where: { id: UserId } });
    var loggedUserPosts = await loggedUser.getPosts();
  } catch (err) {
    console.log(err);
  }
  return loggedUserPosts;
};
