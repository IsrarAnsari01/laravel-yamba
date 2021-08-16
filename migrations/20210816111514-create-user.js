"use strict";
module.exports = {
  up: async (queryInterface, Sequelize) => {
    await queryInterface.createTable("User", {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER,
      },
      name: {
        type: Sequelize.STRING,
        allowNull: false,
        min: 5,
        max: 100,
        is: /^[A-Za-z .]+$/i,
      },
      gender: {
        type: Sequelize.STRING,
        allowNull: false,
        min: 4,
        max: 7,
        is: /^[A-Za-z .]+$/i,
      },
      role: {
        type: Sequelize.STRING,
        allowNull: false,
        min: 4,
        max: 20,
        is: /^[A-Za-z .]+$/i,
      },
      email: {
        type: Sequelize.STRING(40),
        allowNull: false, // This will make it req field
        unique: true,
        isEmail: true,
      },
      password: {
        type: Sequelize.STRING(40),
        allowNull: false, // This will make it req field
        unique: true, // This will make it req field
        min: 6,
        max: 16,
        is: /^(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]+$/i,
      },
      createdAt: {
        allowNull: false,
        type: Sequelize.DATE,
      },
      updatedAt: {
        allowNull: false,
        type: Sequelize.DATE,
      },
    });
  },
  down: async (queryInterface, Sequelize) => {
    await queryInterface.dropTable("User");
  },
};
