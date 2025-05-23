package config

import (
	"fmt"
	"log"

	// "lumina_skincare/models"
	"os"

	"github.com/joho/godotenv"
	"gorm.io/driver/mysql"
	"gorm.io/gorm"
)

var DB *gorm.DB

func ConnectDB() {
	err := godotenv.Load()
	if err != nil {
		log.Println("⚠️ Warning: .env file not found, using default environment variables")
	}

	dsn := fmt.Sprintf("%s:%s@tcp(%s:%s)/%s?charset=utf8mb4&parseTime=True&loc=Local",
		os.Getenv("DB_USER"),
		os.Getenv("DB_PASSWORD"),
		os.Getenv("DB_HOST"),
		os.Getenv("DB_PORT"),
		os.Getenv("DB_NAME"),
	)

	db, err := gorm.Open(mysql.Open(dsn), &gorm.Config{})
	if err != nil {
		log.Fatalf("❌ Failed to connect to database: %v", err)
	}

	fmt.Println("✅ Database connected!")
	DB = db
	
}

// Fungsi untuk mendapatkan instance DB
func GetDB() *gorm.DB {
	if DB == nil {
		log.Println("⚠️  GetDB() mengembalikan nil! Pastikan ConnectDB() dipanggil di main.go")
	}
	return DB
}



