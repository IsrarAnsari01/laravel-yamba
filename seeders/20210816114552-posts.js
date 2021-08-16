"use strict";

module.exports = {
  up: async (queryInterface, Sequelize) => {
    await queryInterface.bulkInsert(
      "post",
      [
        {
          id: 1,
          title: "IA 01",
          userId: 3,
          body: "THis is test post",
          createdAt: new Date(),
          updatedAt: new Date(),
        },
        {
          id: 2,
          title: "IA 02",
          userId: 2,
          body: "THis is test post",
          createdAt: new Date(),
          updatedAt: new Date(),
        },
        {
          id: 3,
          title: "IA 03",
          userId: 4,
          body: "THis is test post",
          createdAt: new Date(),
          updatedAt: new Date(),
        },
        {
          id: 4,
          title: "IA 04",
          userId: 4,
          body: "THis is test post",
          createdAt: new Date(),
          updatedAt: new Date(),
        },
      ],
      {}
    );
  },

  down: async (queryInterface, Sequelize) => {
    /**
     * Add commands to revert seed here.
     *
     * Example:
     * await queryInterface.bulkDelete('People', null, {});
     */
  },
};
