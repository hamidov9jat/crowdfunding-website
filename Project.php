<?php

class Project
{
    private int $idProject;
    private string $projectName;
    private string $projectDescription;
    private string $projectStartDate;
    private string $projectEndDate;
    private float $requestedFund;
    private int $owner_id;

//    /**
//     * @param int $idProject
//     */
//    public function __construct(int $idProject)
//    {
//        $this->idProject = $idProject;
//        $query = "select * from projects where idProject = '$idProject'";
//        $run_query = mysqli_query($link, $query);//here run the sql query.
//
//    }
    /**
     * @param int $idProject
     * @param string $projectName
     * @param string $projectDescription
     * @param string $projectStartDate
     * @param string $projectEndDate
     * @param float $requestedFund
     * @param int $owner_id
     */
    public function __construct(int $idProject, string $projectName, string $projectDescription, string $projectStartDate, string $projectEndDate, float $requestedFund, int $owner_id)
    {
        $this->idProject = $idProject;
        $this->projectName = $projectName;
        $this->projectDescription = $projectDescription;
        $this->projectStartDate = $projectStartDate;
        $this->projectEndDate = $projectEndDate;
        $this->requestedFund = $requestedFund;
        $this->owner_id = $owner_id;
    }


    /**
     * @return int
     */
    public function getIdProject(): int
    {
        return $this->idProject;
    }

    /**
     * @param int $idProject
     */
    public function setIdProject(int $idProject): void
    {
        $this->idProject = $idProject;
    }

    /**
     * @return string
     */
    public function getProjectName(): string
    {
        return $this->projectName;
    }

    /**
     * @param string $projectName
     */
    public function setProjectName(string $projectName): void
    {
        $this->projectName = $projectName;
    }

    /**
     * @return string
     */
    public function getProjectDescription(): string
    {
        return $this->projectDescription;
    }

    /**
     * @param string $projectDescription
     */
    public function setProjectDescription(string $projectDescription): void
    {
        $this->projectDescription = $projectDescription;
    }

    /**
     * @return string
     */
    public function getProjectStartDate(): string
    {
        return $this->projectStartDate;
    }

    /**
     * @param string $projectStartDate
     */
    public function setProjectStartDate(string $projectStartDate): void
    {
        $this->projectStartDate = $projectStartDate;
    }

    /**
     * @return string
     */
    public function getProjectEndDate(): string
    {
        return $this->projectEndDate;
    }

    /**
     * @param string $projectEndDate
     */
    public function setProjectEndDate(string $projectEndDate): void
    {
        $this->projectEndDate = $projectEndDate;
    }

    /**
     * @return float
     */
    public function getRequestedFund(): float
    {
        return $this->requestedFund;
    }

    /**
     * @param float $requestedFund
     */
    public function setRequestedFund(float $requestedFund): void
    {
        $this->requestedFund = $requestedFund;
    }

    /**
     * @return int
     */
    public function getOwnerId(): int
    {
        return $this->owner_id;
    }

    /**
     * @param int $owner_id
     */
    public function setOwnerId(int $owner_id): void
    {
        $this->owner_id = $owner_id;
    }

}