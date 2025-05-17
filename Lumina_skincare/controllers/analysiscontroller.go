package controllers

import (
	"lumina_skincare/config"
	"lumina_skincare/models"
	"lumina_skincare/services"
	"net/http"

	"github.com/gin-gonic/gin"
)

// GetAnalysis mengambil semua data analysis dari database
func GetAnalysis(c *gin.Context) {
	var analysis []models.Analysis
	if err := config.DB.Find(&analysis).Error; err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": err.Error()})
		return
	}
	c.JSON(http.StatusOK, analysis)
}

// GetAnalysisByID mengambil satu analysis berdasarkan ID
func GetAnalysisByID(c *gin.Context) {
	var analysis models.Analysis
	id := c.Param("id")

	if err := config.DB.First(&analysis, id).Error; err != nil {
		c.JSON(http.StatusNotFound, gin.H{"error": "Analysis not found"})
		return
	}
	c.JSON(http.StatusOK, analysis)
}

// CreateAnalysis menambahkan analysis baru ke database
func CreateAnalysis(c *gin.Context) {
	var analysis models.Analysis
	if err := c.ShouldBindJSON(&analysis); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	analysis.AnalysisID = 0 // Reset ID agar auto increment berjalan

	if err := config.DB.Create(&analysis).Error; err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": err.Error()})
		return
	}
	c.JSON(http.StatusCreated, analysis)
}

// UpdateAnalysis memperbarui data analysis berdasarkan ID
func UpdateAnalysis(c *gin.Context) {
	id := c.Param("id") // Ambil ID dari parameter URL

	var analysis models.Analysis
	if err := config.DB.First(&analysis, id).Error; err != nil {
		c.JSON(http.StatusNotFound, gin.H{"error": "Analysis not found"})
		return
	}

	// Bind JSON ke struct
	if err := c.ShouldBindJSON(&analysis); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": err.Error()})
		return
	}

	// Simpan perubahan ke database
	if err := config.DB.Save(&analysis).Error; err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": err.Error()})
		return
	}

	c.JSON(http.StatusOK, gin.H{"message": "Analysis updated successfully", "data": analysis})
}


// DeleteAnalysis menghapus analysis berdasarkan ID
func DeleteAnalysis(c *gin.Context) {
	var analysis models.Analysis
	id := c.Param("id")

	if err := config.DB.First(&analysis, id).Error; err != nil {
		c.JSON(http.StatusNotFound, gin.H{"error": "Analysis not found"})
		return
	}

	if err := config.DB.Delete(&analysis).Error; err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": err.Error()})
		return
	}
	c.JSON(http.StatusOK, gin.H{"message": "Analysis deleted successfully"})
}

func AnalyzeFaceHandler(c *gin.Context) {
	// Ambil file dari request
	var request struct {
		ImageURL string `json:"image_url" binding:"required"`
	}

	// Bind JSON dari request
	if err := c.ShouldBindJSON(&request); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": "Invalid request, image_url is required"})
		return
	}

	// Kirim URL gambar ke service analisis wajah (Python)
	analysisResult, err := services.AnalyzeFace(request.ImageURL)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "Failed to analyze face", "details": err.Error()})
		return
	}

	// Kirim hasil analisis ke user
	c.JSON(http.StatusOK, gin.H{
		"message":  "Face analyzed successfully",
		"analysis": analysisResult,
	})
}